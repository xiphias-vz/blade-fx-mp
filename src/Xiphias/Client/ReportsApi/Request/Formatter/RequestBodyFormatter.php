<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Client\ReportsApi\Request\Formatter;

use Generated\Shared\Transfer\BladeFxParameterTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

class RequestBodyFormatter implements RequestBodyFormatterInterface
{
    /**
     * @param \Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer $requestTransfer
     *
     * @return array
     */
    public function formatDataBeforeEncoding(AbstractTransfer $requestTransfer): array
    {
        $data = $requestTransfer->toArray(true, true);

        $data = $this->changeArrayFromCamelCaseToSnakeCase($data);
        if ($this->parameterTransferIsValid($requestTransfer->getParams())) {
            return $this->mergeParametersWithData($data, $requestTransfer->getParams());
        }

        return $data;
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxParameterTransfer|null $parameterTransfer
     *
     * @return bool
     */
    protected function parameterTransferIsValid(?BladeFxParameterTransfer $parameterTransfer): bool
    {
        if ($parameterTransfer) {
            if ($parameterTransfer->getParamName() && $parameterTransfer->getParamValue()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param array $data
     * @param \Generated\Shared\Transfer\BladeFxParameterTransfer|null $parameterTransfer
     *
     * @return array
     */
    protected function mergeParametersWithData(array $data, ?BladeFxParameterTransfer $parameterTransfer): array
    {
        $params = $parameterTransfer->toArray(true, true);
        $data['params'] = [$this->changeArrayFromCamelCaseToSnakeCase($params)];
        $data['imageFormat'] = '';

        return $data;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function changeArrayFromCamelCaseToSnakeCase(array $data): array
    {
        $changedData = [];
        $keysToChangeFromCamelCase = [
            'repId' => 1, 'layoutId' => 1, 'paramId' => 1, 'hostAddress' => 1, 'userId' => 1, 'connId' => 1, //u getUserEntity UserId treba biti u camel caseu ali otom potom
        ];

        foreach ($data as $camelKey => $value) {
            if (array_key_exists($camelKey, $keysToChangeFromCamelCase)) {
                $changedData[$this->changeKeyFromCamelCaseToSnakeCase($camelKey)] = $value;
            } else {
                $changedData[$camelKey] = $value;
            }
        }

        return $changedData;
    }

    /**
     * @param string $camelKey
     *
     * @return string
     */
    private function changeKeyFromCamelCaseToSnakeCase(string $camelKey): string
    {
        $result = '';
        $camelKeyLen = strlen($camelKey);

        for ($i = 0; $i < $camelKeyLen; $i++) {
            $char = $camelKey[$i];

            if (ctype_upper($char)) {
                $result .= '_' . strtolower($char);
            } else {
                $result .= $char;
            }
        }

        return ltrim($result, '_');
    }
}
