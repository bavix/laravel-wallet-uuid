<?php

declare(strict_types=1);

namespace Bavix\WalletUuid\Test\Infra;

use Ramsey\Uuid\Uuid;

trait Uuids
{
    public function getKeyType(): string
    {
        return 'string';
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(static function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
            }
        });
    }
}
