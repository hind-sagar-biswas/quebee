<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee;

class SanitizeWord
{
    public static function sanitize(string $w): string {
        $reservedKeywords = [
            'ADD',
            'ALL',
            'ALTER',
            'ANALYZE',
            'AND',
            'AS',
            'ASC',
            'BEFORE',
            'BETWEEN',
            'BY',
            'CALL',
            'CASCADE',
            'CASE',
            'CHANGE',
            'CHECK',
            'COLLATE',
            'COLUMN',
            'CONDITION',
            'CONSTRAINT',
            'CONTINUE',
            'CONVERT',
            'CREATE',
            'CROSS',
            'CURRENT_DATE',
            'CURRENT_TIME',
            'CURRENT_TIMESTAMP',
            'CURRENT_USER',
            'CURSOR',
            'DATABASE',
            'DATABASES',
            'DAY_HOUR',
            'DAY_MICROSECOND',
            'DAY_MINUTE',
            'DAY_SECOND',
            'DEC',
            'DECIMAL',
            'DECLARE',
            'DEFAULT',
            'DELAYED',
            'DELETE',
            'DESC',
            'DESCRIBE',
            'DETERMINISTIC',
            'DISTINCT',
            'DISTINCTROW',
            'DIV',
            'DOUBLE',
            'DROP',
            'DUAL',
            'EACH',
            'ELSE',
            'ELSEIF',
            'ENCLOSED',
            'ESCAPED',
            'EXISTS',
            'EXIT',
            'EXPLAIN',
            'FALSE',
            'FETCH',
            'FLOAT',
            'FLOAT4',
            'FLOAT8',
            'FOR',
            'FORCE',
            'FOREIGN',
            'FROM',
            'FULLTEXT',
            'GOTO',
            'GRANT',
            'GROUP',
            'HAVING',
            'HIGH_PRIORITY',
            'HOUR_MICROSECOND',
            'HOUR_MINUTE',
            'HOUR_SECOND',
            'IF',
            'IGNORE',
            'IN',
            'INDEX',
            'INFILE',
            'INNER',
            'INOUT',
            'INSENSITIVE',
            'INSERT',
            'INT',
            'INT1',
            'INT2',
            'INT3',
            'INT4',
            'INT8',
            'INTEGER',
            'INTERVAL',
            'INTO',
            'IS',
            'ITERATE',
            'JOIN',
            'KEY',
            'KEYS',
            'KILL',
            'LEADING',
            'LEAVE',
            'LEFT',
            'LIKE',
            'LIMIT',
            'LINEAR',
            'LINES',
            'LOAD',
            'LOCALTIME',
            'LOCALTIMESTAMP',
            'LOCK',
            'LONG',
            'LONGBLOB',
            'LONGTEXT',
            'LOOP',
            'LOW_PRIORITY',
            'MASTER_SSL_VERIFY_SERVER_CERT',
            'MATCH',
            'MAXVALUE',
            'MEDIUMBLOB',
            'MEDIUMINT',
            'MEDIUMTEXT',
            'MIDDLEINT',
            'MINUTE_MICROSECOND',
            'MINUTE_SECOND',
            'MOD',
            'MODIFIES',
            'NATURAL',
            'NOT',
            'NO_WRITE_TO_BINLOG',
            'NULL',
            'NUMERIC',
            'ON',
            'OPTIMIZE',
            'OPTION',
            'OPTIONALLY',
            'OR',
            'ORDER',
            'OUT',
            'OUTER',
            'OUTFILE',
            'PRECISION',
            'PRIMARY',
            'PROCEDURE',
            'PURGE',
            'RANGE',
            'RANK',
            'READ',
            'READS',
            'READ_WRITE',
            'REAL',
            'REFERENCES',
            'REGEXP',
            'RELEASE',
            'RENAME',
            'REPEAT',
            'REPLACE',
            'REQUIRE',
            'RESTRICT',
            'RETURN',
            'REVOKE',
            'RIGHT',
            'RLIKE',
            'SCHEMA',
            'SCHEMAS',
            'SECOND_MICROSECOND',
            'SELECT',
            'SENSITIVE',
            'SEPARATOR',
            'SET',
            'SHOW',
            'SMALLINT',
            'SPATIAL',
            'SPECIFIC',
            'SQL',
            'SQLEXCEPTION',
            'SQLSTATE',
            'SQLWARNING',
            'SQL_BIG_RESULT',
            'SQL_CALC_FOUND_ROWS',
            'SQL_SMALL_RESULT',
            'SSL',
            'STARTING',
            'STRAIGHT_JOIN',
            'TABLE',
            'TERMINATED',
            'THEN',
            'TINYBLOB',
            'TINYINT',
            'TINYTEXT',
            'TO',
            'TRAILING',
            'TRIGGER',
            'TRUE',
            'UNDO',
            'UNION',
            'UNIQUE',
            'UNLOCK',
            'UNSIGNED',
            'UPDATE',
            'USAGE',
            'USE',
            'USING',
            'UTC_DATE',
            'UTC_TIME',
            'UTC_TIMESTAMP',
            'VALUES',
            'VARBINARY',
            'VARCHAR',
            'VARCHARACTER',
            'VARYING',
            'WHEN',
            'WHERE',
            'WHILE',
            'WITH',
            'WRITE',
            'XOR',
            'YEAR_MONTH',
            'ZEROFILL'
        ];

        return in_array(strtoupper($w), $reservedKeywords) ? "`$w`" : $w;
    }

    public static function run(string $word): string
    {
        if (strpos($word, '.')) {
            $words = explode('.', $word);
            $words = array_map(fn (string $w): string => self::sanitize($w), $words);
            return implode('.', $words);
        }
        return self::sanitize($word);
    }
}
