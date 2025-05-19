<?php

namespace App\Enums\Trait;

enum ModelName: string
{
    case Chat = 'chat';
    case Message = 'message';
    case Reply = 'reply';
    case Notification = 'notification';
    case Route = 'route';
    case Website = 'website';
    case Course = 'course';
    case Section = 'section';
    case Group = 'group';
    case LearningActivity = 'learning activity';
    case Image = 'image';
    case Pdf = 'pdf';
    case Video = 'video';
    case File = 'file';
    case Files = 'files';
    case Chunk = 'chunk';
    case User = 'user';
    case Category = 'category';
    case SubCategory = 'sub_category';
    case PasswordReset = 'password_Reset';
    case UserProfile = 'user_profile';
    case Permission = 'permission';
    case NoName = '';

    public static function getEnum(string $value): self
    {
        return match (true) {
            $value =='Chat' => self::Chat,
            $value =='Message' => self::Message,
            $value =='Reply' => self::Reply,
            $value =='Notification' => self::Notification,
            $value =='Route' => self::Route,
            $value =='Website' => self::Website,
            $value =='Course' => self::Course,
            $value =='Section' => self::Section,
            $value =='Group' => self::Group,
            $value =='LearningActivity' => self::LearningActivity,
            $value =='Image' => self::Image,
            $value =='Pdf' => self::Pdf,
            $value =='Video' => self::Video,
            $value =='File' => self::File,
            $value =='Files' => self::Files,
            $value =='Chunk' => self::Chunk,
            $value =='User' => self::User,
            $value =='Category' => self::Category,
            $value =='SubCategory' => self::SubCategory,
            $value =='PasswordReset' => self::PasswordReset,
            $value =='UserProfile' => self::UserProfile,
            $value =='Permission' => self::Permission,
        };
    }

    public function getModelName(): string
    {
        return match ($this) {
            self::Chat => 'Chat',
            self::Message => 'Message',
            self::Reply => 'Reply',
            self::Notification => 'Notification',
            self::Route => 'Route',
            self::Website => 'Website',
            self::Course => 'Course',
            self::Section => 'Section',
            self::Group => 'Group',
            self::LearningActivity => 'LearningActivity',
            self::Image => 'Image',
            self::Pdf => 'Pdf',
            self::Video => 'Video',
            self::File => 'File',
            self::Files => 'Files',
            self::Chunk => 'Chunk',
            self::User => 'User',
            self::Category => 'Category',
            self::SubCategory => 'SubCategory',
            self::PasswordReset => 'PasswordReset',
            self::UserProfile => 'UserProfile',
            self::Permission => 'Permission',
        };
    }

    public function getMessage(): string
    {
        $key = "Trait/models.{$this->value}.message";
        $translation = __($key);

        if ($key == $translation)
        {
            return "Something went wrong";
        }

        return $translation;
    }
}
