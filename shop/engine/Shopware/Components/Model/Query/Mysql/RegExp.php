<?php
/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */

namespace Shopware\Components\Model\Query\Mysql;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

/**
 * Custom query extension to allow regex comparison in DQL
 *
 * Class RegExp
 */
class RegExp extends FunctionNode
{
    public $regexpExpression = null;
    public $valueExpression = null;

    /**
     * Parse
     *
     * @param Parser $parser
     */
    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->regexpExpression = $parser->StringPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->valueExpression = $parser->StringExpression();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    /**
     * Return SQL expression
     *
     * @param SqlWalker $sqlWalker
     *
     * @return string
     */
    public function getSql(SqlWalker $sqlWalker)
    {
        return '(' . $this->valueExpression->dispatch($sqlWalker) . ' REGEXP ' .
            $sqlWalker->walkStringPrimary($this->regexpExpression) . ')';
    }
}
