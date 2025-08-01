<?php

namespace App\Repositories\AssignmentSubmit;

use App\Repositories\BaseRepository;
use App\Models\AssignmentSubmit\AssignmentSubmit;
use App\DataTransferObjects\AssignmentSubmit\AssignmentSubmitDto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Exceptions\CustomException;
use ZipArchive;

class StudentAssignmentSubmitRepository extends BaseRepository implements AssignmentSubmitRepositoryInterface
{
    public function __construct(AssignmentSubmit $assignmentSubmit) {
        parent::__construct($assignmentSubmit);
    }

    public function all(AssignmentSubmitDto $dto, $data): object
    {
        return (object) $this->model->where('assignment_id', $dto->assignmentId)
            ->where('student_id', $data['studentId'])
            ->with('attachments')
            ->latest('created_at')
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

    public function update(AssignmentSubmitDto $dto, int $id): object
    {
        return (object) [];
    }

    public function delete(int $id): object
    {
        return (object) [];
    }

    public function view(int $id, string $fileName): string
    {
        $model = (object) parent::find($id);

        $exists = Storage::disk('supabase')->exists('AssignmentSubmit/' . $model->id . '/Files/' . $model->student_id . '/' . $fileName);

        if (! $exists)
        {
            throw CustomException::notFound('File');
        }

        $file = Storage::disk('supabase')->get('AssignmentSubmit/' . $model->id . '/Files/' . $model->student_id . '/' . $fileName);
        $encoded = base64_encode($file);
        $decoded = base64_decode($encoded);
        $tempPath = storage_path('app/private/' . $fileName);
        file_put_contents($tempPath, $decoded);

        return $tempPath;
    }

    public function download(int $id): string
    {
        $model = (object) parent::find($id);
        $attachments = $model->attachments;

        if (count($attachments) == 0)
        {
            throw CustomException::notFound('Files');
        }

        $zip = new ZipArchive();
        $zipName = 'Assignment-Submit.zip';
        $zipPath = storage_path('app/private/' . $zipName);

        if ($zip->open($zipPath, ZipArchive::CREATE) === true) {
            foreach ($attachments as $attachment) {
                $file = Storage::disk('supabase')->get('AssignmentSubmit/' . $model->id . '/Files/' . $model->student_id . '/' . $attachment->url);
                $encoded = base64_encode($file);
                $decoded = base64_decode($encoded);
                $tempPath = storage_path('app/private/' . $attachment->url);
                file_put_contents($tempPath, $decoded);
                $zip->addFromString(basename($tempPath), file_get_contents($tempPath));
            }
            $zip->close();
        }

        return $zipPath;
    }
}
