<?php

namespace Trin4ik\NovaSwitcher;

use Laravel\Nova\Fields\Boolean;

class NovaSwitcher extends Boolean
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-switcher';

    public $textAlign = 'center';

    public $defaultConfirm = 'Are you sure?';

    public function trueLabel (string $label): self
    {
        $this->textAlign = 'left';
        return $this->withMeta([
            'true_label' => $label,
        ]);
    }

    public function falseLabel (string $label): self
    {
        $this->textAlign = 'left';
        return $this->withMeta([
            'false_label' => $label,
        ]);
    }

    public function withLabels (null|string $true = null, null|string $false = null): self
    {
        $this->trueLabel($true);
        $this->falseLabel($false);

        return $this;
    }

    public function reverse (): self
    {
        return $this->withMeta([
            'reverse' => true,
        ]);
    }

    public function confirmToTrue (string $confirm): self
    {
        return $this->withMeta([
            'confirm_to_true' => $confirm,
        ]);
    }

    public function confirmToFalse (string $confirm): self
    {
        return $this->withMeta([
            'confirm_to_false' => $confirm,
        ]);
    }

    public function confirm (null|string $toTrue = null, null|string $toFalse = null): self
    {
        $this->confirmToTrue($toTrue ?? $this->defaultConfirm);
        $this->confirmToFalse($toFalse ?? $toTrue ?? $this->defaultConfirm);
        return $this;
    }
}
