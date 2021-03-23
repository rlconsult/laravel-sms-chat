<?php

namespace Filament\Resources\Forms;

use Filament\Resources\Forms\Form;

trait HasForm
{
    use \Filament\Forms\HasForm;

    public function form(Form $form)
    {
        return $form;
    }

    public function getForm()
    {
        if ($this->form !== null) {
            return $this->form;
        }

        return $this->form = $this->form(
            Form::for($this),
        );
    }
}
