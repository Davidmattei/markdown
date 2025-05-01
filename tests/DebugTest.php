<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Tests;

use Fabricity\Markdown\Markdown;
use PHPUnit\Framework\TestCase;

class DebugTest extends TestCase
{
    public function testDevelop(): void
    {
        $input = <<<MARKDOWN
# Title

## Sub title

# Cool 3


### Test 1
MARKDOWN;

        $result = <<<HTML
<h1 id="title">Title</h1>
<h2 id="sub-title">Sub title</h2>
<h1 id="cool-3">Cool 3</h1>
<h3 id="test-1">Test 1</h3>
HTML;

        $markdown = new Markdown();

        $this->assertSame($result, $markdown->parse($input));
    }
}
