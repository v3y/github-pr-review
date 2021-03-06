<?php

/**
 * @author BaBeuloula <info@babeuloula.fr>
 */

declare(strict_types=1);

namespace App\Entity;

use App\Enum\Color;
use App\Enum\NotificationReason;
use App\Enum\UseMode;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConfigurationRepository")
 */
class Configuration
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array")
     */
    private $repositories = [];

    /**
     * @ORM\Column(type="use_mode", length=25)
     */
    private $mode;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $labelsReviewNeeded = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $labelsChangesRequested = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $labelsAccepted = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $labelsWip = [];

    /**
     * @ORM\Column(type="array")
     */
    private $branchsColors = [];

    /**
     * @ORM\Column(type="color", length=25)
     */
    private $branchDefaultColor;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $filters = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $notificationsExcludeReasons = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $notificationsExcludeReasonsOtherRepos = [];

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabledDarkTheme;

    /**
     * @ORM\Column(type="boolean")
     */
    private $reloadOnFocus;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $reloadEvery;

    /**
     * @var User|null
     * @OneToOne(targetEntity="User", inversedBy="configuration")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    /** @return string[] */
    public function getRepositories(): array
    {
        return $this->repositories ?? [];
    }

    public function setRepositories(array $repositories): self
    {
        $this->repositories = $repositories;

        return $this;
    }

    public function getMode(): UseMode
    {
        return $this->mode ?? new UseMode('label');
    }

    public function setMode(UseMode $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    /** @return string[] */
    public function getLabelsReviewNeeded(): array
    {
        return $this->labelsReviewNeeded ?? [];
    }

    /** @param string[] $labelsReviewNeeded */
    public function setLabelsReviewNeeded(array $labelsReviewNeeded): self
    {
        $this->labelsReviewNeeded = $labelsReviewNeeded;

        return $this;
    }

    /** @return string[] */
    public function getLabelsChangesRequested(): array
    {
        return $this->labelsChangesRequested ?? [];
    }

    /** @param string[] $labelsChangesRequested */
    public function setLabelsChangesRequested(array $labelsChangesRequested): self
    {
        $this->labelsChangesRequested = $labelsChangesRequested;

        return $this;
    }

    /** @return string[] */
    public function getLabelsAccepted(): array
    {
        return $this->labelsAccepted ?? [];
    }

    /** @param string[] $labelsAccepted */
    public function setLabelsAccepted(array $labelsAccepted): self
    {
        $this->labelsAccepted = $labelsAccepted;

        return $this;
    }

    /** @return string[] */
    public function getLabelsWip(): array
    {
        return $this->labelsWip ?? [];
    }

    /** @param string[] $labelsWip */
    public function setLabelsWip(array $labelsWip): self
    {
        $this->labelsWip = $labelsWip;

        return $this;
    }

    /** @return string[] */
    public function getBranchsColors(): array
    {
        return $this->branchsColors ?? [];
    }

    /** @param array[] $branchsColors */
    public function setBranchsColors(array $branchsColors): self
    {
        $this->branchsColors = $branchsColors;

        return $this;
    }

    public function getBranchDefaultColor(): Color
    {
        return $this->branchDefaultColor ?? new Color('primary');
    }

    public function setBranchDefaultColor(Color $branchDefaultColor): self
    {
        $this->branchDefaultColor = $branchDefaultColor;

        return $this;
    }

    /** @return string[] */
    public function getFilters(): array
    {
        return $this->filters ?? [];
    }

    /** @param string[] $filters */
    public function setFilters(array $filters): self
    {
        $this->filters = $filters;

        return $this;
    }

    /** @return NotificationReason[] */
    public function getNotificationsExcludeReasons(): array
    {
        return array_map(
            function (string $reason): NotificationReason {
                return new NotificationReason($reason);
            },
            $this->notificationsExcludeReasons ?? []
        );
    }

    /** @param NotificationReason[] $notificationsExcludeReasons */
    public function setNotificationsExcludeReasons(array $notificationsExcludeReasons): self
    {
        $this->notificationsExcludeReasons = array_map(
            function (NotificationReason $reason): string {
                return $reason->getValue();
            },
            $notificationsExcludeReasons
        );

        return $this;
    }

    /** @return NotificationReason[] */
    public function getNotificationsExcludeReasonsOtherRepos(): array
    {
        return array_map(
            function (string $reason): NotificationReason {
                return new NotificationReason($reason);
            },
            $this->notificationsExcludeReasonsOtherRepos ?? []
        );
    }

    /** @param NotificationReason[] $notificationsExcludeReasonsOtherRepos */
    public function setNotificationsExcludeReasonsOtherRepos(array $notificationsExcludeReasonsOtherRepos): self
    {
        $this->notificationsExcludeReasonsOtherRepos = array_map(
            function (NotificationReason $reason): string {
                return $reason->getValue();
            },
            $notificationsExcludeReasonsOtherRepos
        );

        return $this;
    }

    public function getEnabledDarkTheme(): bool
    {
        return $this->enabledDarkTheme ?? false;
    }

    public function setEnabledDarkTheme(bool $enabledDarkTheme): self
    {
        $this->enabledDarkTheme = $enabledDarkTheme;

        return $this;
    }

    public function getReloadOnFocus(): bool
    {
        return $this->reloadOnFocus ?? false;
    }

    public function setReloadOnFocus(bool $reloadOnFocus): self
    {
        $this->reloadOnFocus = $reloadOnFocus;

        return $this;
    }

    public function getReloadEvery(): int
    {
        return $this->reloadEvery ?? 0;
    }

    public function setReloadEvery(int $reloadEvery): self
    {
        $this->reloadEvery = $reloadEvery;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
