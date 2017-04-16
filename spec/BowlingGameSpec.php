<?php
declare(strict_types=1);

namespace spec;

use PhpSpec\ObjectBehavior;

class BowlingGameSpec extends ObjectBehavior
{
    public function it_plays_a_gutter_game()
    {
        $this->rollMany(20, 0);

        $this->score()->shouldReturn(0);
    }

    public function it_plays_all_ones()
    {
        $this->rollMany(20, 1);

        $this->score()->shouldReturn(20);
    }

    public function it_plays_one_spare()
    {
        $this->rollSpare();
        $this->roll(3);
        $this->rollMany(17, 0);

        $this->score()->shouldReturn(16);
    }

    public function it_plays_one_strike()
    {
        $this->rollStrike();
        $this->roll(3);     // + double 3
        $this->roll(4);     // + double 4
        $this->rollMany(16, 0);

        $this->score()->shouldReturn(24);   // = 10 3*2 + 4*2
    }

    public function it_plays_a_perfect_game()
    {
        $this->rollMany(12, 10);

        $this->score()->shouldReturn(300);
    }

    private function rollMany(int $n, int $pins)
    {
        for ($i = 0; $i < $n; $i++) {
            $this->roll($pins);
        }
    }

    private function rollSpare()
    {
        $this->roll(5);
        $this->roll(5);
    }

    private function rollStrike()
    {
        $this->roll(10);    // strike, go to next frame (-1 on the 20 rolls)
    }
}
