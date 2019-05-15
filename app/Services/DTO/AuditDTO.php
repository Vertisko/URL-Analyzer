<?php


namespace App\Services\DTO;

/**
 * Class AuditDTO
 * @package App\Services\DTO
 */
class AuditDTO extends BaseDTO
{
    /**
     * @var
     */
    private $description;
    /**
     * @var
     */
    private $score;
    /**
     * @var
     */
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
        return $this;
    }

    /**
     * @param mixed $description
     * @return AuditDTO
     */
    public function setDescription($description): AuditDTO
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param string $title
     * @return AuditDTO
     */
    public function setTitle(string $title): AuditDTO
    {
        $this->title = $title;
        return $this;
    }
}
