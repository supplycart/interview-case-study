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
            ->where('is_active', '=', 1)
            ->value(self::$id);
    }

    public static function getValueByLookupType(string $lookupType): \Illuminate\Support\Collection
    {
        return \DB::table(self::$table)
            ->where(self::$type, $lookupType)
            ->where('is_active', '=', 1)
            ->pluck(self::$value, self::$id);
    }

    public static function getValueByID(int $lookupID)
    {
        return \DB::table(self::$table)
            ->where(self::$id, $lookupID)
            ->where('is_active', '=', 1)
            ->value(self::$value);
    }

    public static function getValueByIDs(array $lookupIDs): \Illuminate\Support\Collection
    {
        return \DB::table(self::$table)
            ->whereIn(self::$id, $lookupIDs)
            ->where('is_active', '=', 1)
            ->pluck(self::$value, self::$id);
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

    public static function pluckValuesByType(string $lookupType): array
    {
        return \DB::table(self::$table)
            ->where(self::$type, $lookupType)
            ->where('is_active', '=', 1)
            ->pluck(self::$id, self::$value)
            ->toArray();
    }

    public static function pluckFilterByType(string $lookupType): array
    {
        return \DB::table(self::$table)
            ->where(self::$type, $lookupType)
            ->where('is_active', '=', 1)
            ->pluck(self::$value, self::$id)
            ->toArray();
    }
}
