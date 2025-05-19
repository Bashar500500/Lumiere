<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\Container;
use App\Repositories\Message\MessageRepositoryInterface;
use App\Repositories\Message\MessageRepository;
use App\Models\Message\Message;
use App\Repositories\Reply\ReplyRepositoryInterface;
use App\Repositories\Reply\ReplyRepository;
use App\Models\Reply\Reply;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\Course\CourseRepository;
use App\Models\Course\Course;
use App\Repositories\Group\GroupRepositoryInterface;
use App\Repositories\Group\GroupRepository;
use App\Models\Group\Group;
use App\Repositories\LearningActivity\LearningActivityRepositoryInterface;
use App\Repositories\LearningActivity\LearningActivityRepository;
use App\Models\LearningActivity\LearningActivity;
use App\Repositories\Section\SectionRepositoryInterface;
use App\Repositories\Section\SectionRepository;
use App\Models\Section\Section;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MessageRepositoryInterface::class, function (Container $app) {
            return new MessageRepository($app->make(Message::class),
            );
        });

        $this->app->bind(ReplyRepositoryInterface::class, function (Container $app) {
            return new ReplyRepository($app->make(Reply::class),
            );
        });

        $this->app->bind(CourseRepositoryInterface::class, function (Container $app) {
            return new CourseRepository($app->make(Course::class),
            );
        });

        $this->app->bind(GroupRepositoryInterface::class, function (Container $app) {
            return new GroupRepository($app->make(Group::class),
            );
        });

        $this->app->bind(LearningActivityRepositoryInterface::class, function (Container $app) {
            return new LearningActivityRepository($app->make(LearningActivity::class),
            );
        });

        $this->app->bind(SectionRepositoryInterface::class, function (Container $app) {
            return new SectionRepository($app->make(Section::class),
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
