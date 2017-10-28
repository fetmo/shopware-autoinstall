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

namespace Shopware\Bundle\FormBundle;

class StringRendererService implements StringRendererServiceInterface
{
    /**
     * @var string
     */
    private $placeholderRegEx = '/(\{\$){1}[:\'a-zA-Z0-9\.\|\$_]+(\}){1}/';

    /**
     * @var string
     */
    private $functionRegEx = '/((\{\$){1})|(\})|(\|{1}(.+)\}{1})/';

    /**
     * @var array
     */
    private $whiteListTypeArray = [
        'string',
        'integer',
        'double',
    ];

    /**
     * {@inheritdoc}
     */
    public function render($string, array $viewVariables, array $sElement)
    {
        $placeholders = [];

        if (!preg_match_all($this->placeholderRegEx, $string, $placeholders)) {
            return $string;
        }

        $placeholders = array_shift($placeholders);

        foreach ($placeholders as $placeholder) {
            $placeholderString = preg_replace($this->functionRegEx, '', $placeholder);

            if (strlen($placeholderString) < 1) {
                continue;
            }

            $placeholderArray = explode('.', $placeholderString);

            $viewVariable = $this->getValue($placeholderArray, $viewVariables, $sElement);

            $string = str_replace($placeholder, $viewVariable, $string);
        }

        return $string;
    }

    /**
     * @param array $placeholder
     * @param array $viewVariables
     * @param array $sElement
     *
     * @throws \Exception
     *
     * @return string
     */
    private function getValue(array $placeholder, array $viewVariables, array $sElement)
    {
        $variable = $viewVariables;

        if ($placeholder[0] === 'sElement') {
            $variable = $sElement;
            // remove first element from $placeholder array because its 'sElement'
            array_shift($placeholder);
        }

        while ($currentLayer = array_shift($placeholder)) {
            if (!array_key_exists($currentLayer, $variable)) {
                return '';
            }

            $variable = $variable[$currentLayer];
        }

        if (empty($variable)) {
            return '';
        }

        if (!in_array(gettype($variable), $this->whiteListTypeArray)) {
            throw new \Exception(sprintf('Could not render type of %s', gettype($variable)));
        }

        return (string) $variable;
    }
}
