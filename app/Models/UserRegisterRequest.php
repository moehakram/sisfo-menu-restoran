<?php
namespace app\Models;

class UserRegisterRequest
    {
        public ?string $id = null;
        public ?string $name = null;
        public ?string $password = null;
        public ?int $level = 2;
        public ?int $status = 1;
    }
