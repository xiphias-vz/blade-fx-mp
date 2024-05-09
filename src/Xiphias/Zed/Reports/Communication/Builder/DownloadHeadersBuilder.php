<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Reports\Communication\Builder;

class DownloadHeadersBuilder implements DownloadHeadersBuilderInterface
{
    /**
     * @param string $fileFormat
     *
     * @return array
     */
    public function buildDownloadHeaders(string $fileFormat): array
    {
        return [
            'Content-Type' => $this->getApplicationType($fileFormat),
            'Content-Disposition' => 'attachment; filename=' . 'filename.' . $fileFormat,
            'Pragma' => 'Public',
        ];
    }

    /**
     * @param string $fileFormat
     *
     * @return string
     */
    protected function getApplicationType(string $fileFormat): string
    {
        return match ($fileFormat) {
            'pdf' => 'application/pdf',
            'csv' => 'application/csv',
            'pptx' => 'application/pptx',
            'docx' => 'application/docs',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'mht' => 'application/mht',
            'rtf' => 'application/rtf',
            'jpg' => 'application/jpg',
            default => 'error',
        };
    }
}
