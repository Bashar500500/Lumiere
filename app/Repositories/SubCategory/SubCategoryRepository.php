<?php

namespace App\Repositories\SubCategory;

use App\DataTransferObjects\SubCategory\SubCategoryDto;
use App\Enums\Attachment\AttachmentReferenceField;
use App\Enums\Attachment\AttachmentType;
use App\Models\SubCategory\SubCategory;
use App\Repositories\BaseRepository;
use App\Repositories\SubCategory\SubCategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class SubCategoryRepository extends BaseRepository implements SubCategoryRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(SubCategory $sub_category)
    {
        parent::__construct($sub_category);
    }

    public function all(SubCategoryDto $dto): object
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

    public function create(SubCategoryDto $dto): object
    {
        $sub_category = DB::transaction(function () use ($dto) {
            $sub_category = $this->model->create([
                'name' => $dto->name,
                'status' => $dto->status,
                'description' => $dto->description,
                'category_id' => $dto->categoryId,
            ]);
            if ($dto->SubCategoryImage)
            {
                // here the code for storing in firebase

                $sub_category->attachment()->create([
                    'reference_field' => AttachmentReferenceField::SubCategoryImage,
                    'type' => AttachmentType::Image->getType(),
                    'url' => 'https:\\firebase.com\storedinfirebase',
                ]);
            }

            return $sub_category;
        });

        return (object) $sub_category->load('attachments');
    }

    public function update(SubCategoryDto $dto, int $id): object
    {
        $model = (object) parent::find($id);

        $sub_category = DB::transaction(function () use ($dto, $model) {
            $sub_category = tap($model)->update([
                'name' => $dto->name,
                'description' => $dto->description,
                'status' => $dto->status,
                'category_id' => $dto->categoryId,
            ]);

            // here the code for updating in firebase

            $sub_category->attachment()->update([
                'url' => 'updatedhttps:\\firebase.com\storedinfirebase',
            ]);

            return $sub_category;
        });

        return (object) $sub_category->load('attachments');
    }

    public function delete(int $id): object
    {
        $sub_category = DB::transaction(function () use ($id) {
            return parent::delete($id);
        });

        return (object) $sub_category;
    }
}
