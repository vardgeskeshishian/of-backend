<?php

declare(strict_types=1);

namespace App\Orchid\Screens\User;

use App\Orchid\Layouts\User\ProfilePasswordLayout;
use App\Orchid\Layouts\User\UserAvatarLayout;
use App\Orchid\Layouts\User\UserEditLayout;
use App\Orchid\Layouts\User\UserTokenLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Orchid\Access\Impersonation;
use Orchid\Platform\Models\User;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class UserProfileScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     *
     * @return array
     */
    public function query(Request $request): iterable
    {
        return [
            'user' => $request->user(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    #[\Override]
    public function name(): ?string
    {
        return 'My Account';
    }

    /**
     * Display header description.
     */
    #[\Override]
    public function description(): ?string
    {
        return 'Update your account details such as name, email address and password';
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    #[\Override]
    public function commandBar(): iterable
    {
        return [
            Button::make('Back to my account')
                ->novalidate()
                ->canSee(Impersonation::isSwitch())
                ->icon('bs.people')
                ->route('platform.switch.logout'),

            Button::make('Sign out')
                ->novalidate()
                ->icon('bs.box-arrow-left')
                ->route('platform.logout'),
        ];
    }

    /**
     * @return \Orchid\Screen\Layout[]
     */
    #[\Override]
    public function layout(): iterable
    {
        return [
            Layout::block(UserTokenLayout::class)
                ->title(__('general.personal_token')),

            Layout::block(UserEditLayout::class)
                ->title(__('Profile Information'))
                ->description(__("Update your account's profile information and email address."))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::BASIC())
                        ->icon('bs.check-circle')
                        ->method('save'),
                ),

            Layout::block(ProfilePasswordLayout::class)
                ->title(__('Update Password'))
                ->description(__('Ensure your account is using a long, random password to stay secure.'))
                ->commands(
                    Button::make(__('Update password'))
                        ->type(Color::BASIC())
                        ->icon('bs.check-circle')
                        ->method('changePassword'),
                ),

            Layout::block(UserAvatarLayout::class)
                ->title(__('general.avatar'))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::BASIC)
                        ->icon('bs.check-circle')
                        ->method('uploadAvatar'),
                ),
        ];
    }

    public function uploadAvatar(Request $request): void
    {
        $request->validate([
            'user.avatar' => 'required|string',
        ]);

        $request->user()
            ->forceFill($request->get('user'))
            ->save();

        Toast::info(__('Profile updated.'));
    }

    public function save(Request $request): void
    {
        $request->validate([
            'user.name'  => 'required|string',
            'user.email' => [
                'required',
                Rule::unique(User::class, 'email')->ignore($request->user()),
            ],
        ]);

        $request->user()
            ->fill($request->get('user'))
            ->save();

        Toast::info(__('Profile updated.'));
    }

    public function changePassword(Request $request): void
    {
        $guard = config('platform.guard', 'web');
        $request->validate([
            'old_password' => 'required|current_password:' . $guard,
            'password'     => 'required|confirmed|different:old_password',
        ]);

        tap($request->user(), function ($user) use ($request): void {
            $user->password = Hash::make($request->get('password'));
        })->save();

        Toast::info(__('Password changed.'));
    }
}
