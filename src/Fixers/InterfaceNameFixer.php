<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Standards\Fixers;

use PhpCsFixer\AbstractFixer;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;

final class InterfaceNameFixer extends AbstractFixer
{
    private const string SUFFIX = 'Interface';

    #[\Override()]
    public function getName(): string
    {
        return 'Architecture/interface_name_fixer';
    }

    #[\Override()]
    public function getDefinition(): FixerDefinitionInterface
    {
        return new FixerDefinition(
            'Exception classes should have suffix "Interface".',
            [],
        );
    }

    /**
     * @param \PhpCsFixer\Tokenizer\Tokens<\PhpCsFixer\Tokenizer\Token> $tokens
     */
    #[\Override()]
    public function isCandidate(Tokens $tokens): bool
    {
        return $tokens->isAllTokenKindsFound([\T_INTERFACE]);
    }

    /**
     * @param \PhpCsFixer\Tokenizer\Tokens<\PhpCsFixer\Tokenizer\Token> $tokens
     */
    #[\Override()]
    protected function applyFix(\SplFileInfo $file, Tokens $tokens): void
    {
        foreach ($tokens as $index => $token) {
            if (!$token->isGivenKind(\T_INTERFACE)) {
                continue;
            }

            $classNameIndex = $tokens->getNextMeaningfulToken($index);
            $classNameToken = $tokens[$classNameIndex]->getContent();

            if (\str_ends_with($classNameToken, self::SUFFIX)) {
                continue;
            }

            $tokens[$classNameIndex] = new Token([\T_STRING, $classNameToken.self::SUFFIX]);
        }
    }
}
