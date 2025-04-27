<?php

namespace App\Repositories\Category;

use App\DataTransferObjects\Category\CategoryDto;
use App\Enums\Attachment\AttachmentReferenceField;
use App\Enums\Attachment\AttachmentType;
use App\Enums\Model\ModelTypePath;
use App\Models\Category\Category;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }

    public function all(CategoryDto $dto): object
    {
        return (object) $this->model->get()
            ->with('attachments')
            ->simplePaginate(
                $dto->pageSize,
                ['*'],
                'page',
                $dto->currentPage,
            );
    }

    public function find(int $id): object
    {
        return (object) parent::find($id)
        ->load('attachments');
    }

    public function create(CategoryDto $dto): object
    {
        $category = DB::transaction(function () use ($dto) {
            $category = $this->model->create([
                'name' => $dto->name,
                'status' => $dto->status,
                'description' => $dto->description,
            ]);
            if ($dto->categoryImage)
            {
                // here the code for storing in firebase

                $category->attachment()->create([
                    'reference_field' => AttachmentReferenceField::CategoryImage,
                    'type' => AttachmentType::Image->getType(),
                    'url' => 'https:\\firebase.com\storedinfirebase',
                ]);
            }

            return $category;
        });

        return (object) $category->load('attachments');
    }

    public function update(CategoryDto $dto, int $id): object
    {
        $model = (object) parent::find($id);

        $course = DB::transaction(function () use ($dto, $model) {
            $course = tap($model)->update([
                'name' => $dto->name,
                'description' => $dto->description,
                'status' => $dto->status,
            ]);

            // here the code for updating in firebase

            $course->attachment()->update([
                'url' => 'updatedhttps:\\firebase.com\storedinfirebase',
            ]);

            return $course;
        });

        return (object) $course->load('attachments');
    }

    public function delete(int $id): object
    {
        $message = DB::transaction(function () use ($id) {
            return parent::delete($id);
        });

        return (object) $message;
    }
}
