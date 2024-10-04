<?php

namespace App\Helpers;

class MasterLookupHelper
{
    private static string $table = 'master_lookups';

    private static string $id = 'id';

    private static string $type = 'type';

    private static string $value = 'value';

    private static array $getKeyByLookUpTypeCache = [];

    /**
     * Getting ID status by its type and value.
     */
    public static function getStatusID(string $lookupType, string $lookupValue)
    {
        return \DB::table(self::$table)
            ->select([self::$id])
            ->where(self::$type, $lookupType)
            ->where(self::$value, $lookupValue)
            ->whereNull('deleted_at')
            ->value(self::$id);
    }

    public static function getKeyByLookUpType(string $lookUpType): array
    {
        $results = \DB::table(self::$table);

        if ($lookUpType !== 'all') {
            $results->where(self::$type, $lookUpType);
        }

        if (!isset(self::$getKeyByLookUpTypeCache[$lookUpType])) {
            self::$getKeyByLookUpTypeCache[$lookUpType] = $results->pluck(self::$id, self::$value)
                ->toArray();
        }

        return self::$getKeyByLookUpTypeCache[$lookUpType];
    }
}
