<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Forms\Components\Component;

class Login extends BaseLogin
{
  protected function getEmailFormComponent(): Component
  {
    return parent::getEmailFormComponent()
      ->label('Email')
      ->placeholder('Type your email');
  }

  protected function getPasswordFormComponent(): Component
  {
    return parent::getPasswordFormComponent()
      ->placeholder('Type your password');
  }
}
