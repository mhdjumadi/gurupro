<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class Profile extends Page
{
    protected static ?string $title = 'Edit Profil';

    protected static ?string $navigationLabel = 'Edit Profil';

    protected static bool $shouldRegisterNavigation = false;

    protected string $view = 'filament.pages.profile';

    public ?array $data = [];

    public function mount(): void
    {
        $user = auth()->user();

        $this->form->fill([
            'nip' => $user->nip,
            'name' => $user->name,
            'school' => $user->school,
            'email' => $user->email,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Profil')
                    ->description('Perbarui informasi profil akun Anda.')
                    ->schema([
                        TextInput::make('nip')
                            ->label('NIP')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('school')
                            ->label('Sekolah')
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(
                                table: 'users',
                                column: 'email',
                                modifyRuleUsing: function ($rule) {
                                    return $rule->ignore(auth()->id());
                                },
                            ),
                    ])
                    ->columns(2),

                Section::make('Ubah Password')
                    ->description(
                        'Kosongkan jika tidak ingin mengubah password.'
                    )
                    ->schema([
                        TextInput::make('password')
                            ->label('Password Baru')
                            ->password()
                            ->revealable()
                            ->minLength(8)
                            ->dehydrated(
                                fn($state) => filled($state)
                            ),

                        TextInput::make('password_confirmation')
                            ->label('Konfirmasi Password Baru')
                            ->password()
                            ->revealable()
                            ->same('password')
                            ->dehydrated(false),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $user = auth()->user();

        $data = $this->form->getState();

        $user->name = $data['name'];
        $user->nip = $data['nip'];
        $user->school = $data['school'];
        $user->email = $data['email'];

        if (filled($data['password'] ?? null)) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        Notification::make()
            ->title('Profil berhasil diperbarui')
            ->success()
            ->send();

        $this->redirect(static::getUrl());
    }
}