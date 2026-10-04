<?php

namespace App\Services;

use App\Models\User;

class PackageService
{
    public function __construct(
        protected User $user
    ) {
    }

    public function subscription()
    {
        return $this->user->activeSubscription;
    }

    public function package()
    {
        return $this->subscription()?->package;
    }

    public function studentLimit(): ?int
    {
        return $this->user->activeSubscription?->student_limit;
    }

    public function canAddClass(int $amount = 1): bool
    {
        $limit = $this->classLimit();

        if ($limit === null) {
            return false;
        }

        return ($this->usedClasses() + $amount) <= $limit;
    }

    public function classLimit(): ?int
    {
        return $this->user->activeSubscription?->class_limit;
    }

    public function canAddStudents(int $amount = 1): bool
    {
        $limit = $this->studentLimit();

        if ($limit === null) {
            return false;
        }

        return ($this->usedStudents() + $amount) <= $limit;
    }

    public function usedClasses(): int
    {
        return $this->user->classes()->count();
    }

    public function usedStudents(): int
    {
        return $this->user->classes()
            ->withCount('students')
            ->get()
            ->sum('students_count');
    }
}