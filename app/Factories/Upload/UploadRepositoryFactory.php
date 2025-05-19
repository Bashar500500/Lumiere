<?php

namespace App\Factories\Upload;

use Illuminate\Contracts\Container\Container;
use App\Enums\Trait\ModelName;
use App\Repositories\Course\CourseRepository;
use App\Repositories\Group\GroupRepository;
use App\Repositories\LearningActivity\LearningActivityRepository;
use App\Repositories\Section\SectionRepository;

class UploadRepositoryFactory
{
    public function __construct(
        protected Container $container,
    ) {}

    public function make(ModelName $name): CourseRepository|GroupRepository|LearningActivityRepository|SectionRepository
    {
        return match ($name) {
            ModelName::Course => $this->container->make(CourseRepository::class),
            ModelName::Group => $this->container->make(GroupRepository::class),
            ModelName::LearningActivity => $this->container->make(LearningActivityRepository::class),
            ModelName::Section => $this->container->make(SectionRepository::class),
        };
    }
}
