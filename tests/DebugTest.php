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



blablabla
coool



fdsfsqdfqs
test,
test,



MARKDOWN;

        $result = <<<HTML
<h1 id="title">Title</h1>
<p>blablabla
coool</p>
<p>fdsfsqdfqs
test,
test,</p>
HTML;

        $markdown = new Markdown();

        $this->assertSame($result, $markdown->parse($input));
    }
}
