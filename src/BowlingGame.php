<?php
declare(strict_types=1);

class BowlingGame
{
    private $rolls = [];

    const MAX_FRAMES = 10;

    public function roll(int $pins)
    {
        $this->rolls[] = $pins;
    }

    public function score() : int
    {
        $score = 0;
        $frameIndex = 0;

        for ($frame = 0; $frame < self::MAX_FRAMES; $frame++) {
            if ($this->isStrike($frameIndex)) {
                $score += 10 + $this->strikeBonus($frameIndex);
                $frameIndex++;
            } elseif ($this->isSpare($frameIndex)) {
                $score += 10 + $this->spareBonus($frameIndex);
                $frameIndex += 2;
            } else {
                $score += $this->sumOfPinsInFrame($frameIndex);
                $frameIndex += 2;
            }
        }

        return $score;
    }

    private function isSpare(int $frameIndex) : bool
    {
        return 10 === $this->sumOfPinsInFrame($frameIndex);
    }

    private function isStrike(int $frameIndex) : bool
    {
        return 10 === $this->rolls[$frameIndex];
    }

    private function spareBonus(int $frameIndex) : int
    {
        return $this->rolls[$frameIndex + 2];
    }

    private function sumOfPinsInFrame(int $frameIndex) : int
    {
        return $this->rolls[$frameIndex] + $this->rolls[$frameIndex + 1];
    }

    private function strikeBonus(int $frameIndex) : int
    {
        return $this->rolls[$frameIndex + 1] + $this->rolls[$frameIndex + 2];
    }
}
