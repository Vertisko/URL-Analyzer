<?php


namespace App\Services\DTO;

class AuditDTO extends BaseDTO
{
    private $description;
    private $score;
    private $title;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param int $score
     * @return AuditDTO
     */
    public function setScore(int $score): AuditDTO
    {
        $this->score = $score;
    }

    /**
     * @param mixed $description
     * @return AuditDTO
     */
    public function setDescription($description): AuditDTO
    {
        $this->description = $description;
    }

    /**
     * @param string $title
     * @return AuditDTO
     */
    public function setTitle(string $title): AuditDTO
    {
        $this->title = $title;
    }
}
