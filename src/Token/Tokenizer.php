<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Token;

class Tokenizer
{
    private int $cursor = 0;
    private int $length;
    /** @var Token[] */
    private array $tokens = [];

    /** @var array<string, ?TokenType> */
    private array $patterns = [
         '/^(?<value>\n)/s' => null,
         '/^(?<value>[^\n].*?)(?=\n\n|$)/s' => TokenType::PARAGRAPH
    ];

    public function __construct(private readonly string $input)
    {
        $this->length = strlen($this->input);
    }

    /** @return Token[] */
    public function getTokens(): array
    {
        return $this->tokens;
    }

    public function tokenize(): void
    {
        while ($this->cursor < $this->length) {
            $subject = substr($this->input, $this->cursor);
            [$tokenType, $value] = $this->match($subject);

            $this->cursor += strlen($value);
        }
    }

    /**
     * @return array{?TokenType, string}
     */
    private function match(string $subject): array
    {
        foreach ($this->patterns as $pattern => $type) {
            if (preg_match($pattern, $subject, $match)) {
                return [$type, $match['value']];
            }
        }

        throw new \RuntimeException('Unexpected token');
    }
}
