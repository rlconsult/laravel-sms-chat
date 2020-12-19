<?php

namespace Filament\Fields;

class Avatar extends Field {
    public $avatar;
    public $user;
    public $deleteMethod;
    public $size = 64;

    /**
     * @return static
     */
    public function avatar($avatar): self
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * @return static
     */
    public function user($user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return static
     */
    public function deleteMethod(string $method): self
    {
        $this->deleteMethod = $method;
        return $this;
    }

    /**
     * @return static
     */
    public function size($size): self
    {
        $this->size = $size;
        return $this;
    }
}