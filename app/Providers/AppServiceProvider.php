<?php

namespace App\Providers;

use App\Models\Category\Category;
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
use App\Models\SubCategory\SubCategory;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\SubCategory\SubCategoryRepositoryInterface;
use App\Repositories\SubCategory\SubCategoryRepository;

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

        $this->app->bind(CategoryRepositoryInterface::class, function (Container $app) {
            return new CategoryRepository($app->make(Category::class),
            );
        });

        $this->app->bind(SubCategoryRepositoryInterface::class, function (Container $app) {
            return new SubCategoryRepository($app->make(SubCategory::class),
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
