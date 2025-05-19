<?php

namespace App\DataTransferObjects\LearningActivity;

use App\Http\Requests\LearningActivity\LearningActivityRequest;
use App\Enums\LearningActivity\LearningActivityMetadataDifficulty;

class LearningActivityMetadataDto
{
    public function __construct(
        public readonly ?LearningActivityMetadataDifficulty $difficulty,
        public readonly ?array $keywords,
    ) {}

    public static function from(LearningActivityRequest $request): LearningActivityMetadataDto
    {
        return new self(
            difficulty: LearningActivityMetadataDifficulty::from($request->validated('metadata.difficulty')),
            keywords: $request->validated('metadata.keywords'),
        );
    }
}
