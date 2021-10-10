# Redis cluster benchmark
Redis cluster benchmark for PhpRedis extension and Predis library.

## Tests parameters
The tests were performed using the [PHPBench](https://github.com/phpbench/phpbench) framework.

Each test was run 50 times. Each run performed a single test another 50 times.
The result for a single test is the average of the memory peak, time, and deviation from 2500 calls.

PHP version: **7.4**

Redis version: **6.2.6**

#### Attention
Docker containers from this project may not work on your environment. More common configuration will be created asap.

## Tests groups
Tests have been assigned to the groups. This makes it possible to run a test for a certain range.

- `phpredis` - run all tests only for PhpRedis extension,
- `predis` - run all tests only for Predis extension,
- `get-string` - run all tests which bench getting simple string directly from Redis,
- `set-string` - run all tests which bench setting simple string directly to Redis,
- `sf-cache-get` - run all tests which bench getting cache item with Symfony Cache Component usage (standard adapter and tag aware adapter),
- `sf-cache-save` - run all tests which bench saving cache item with Symfony Cache Component usage (standard adapter and tag aware adapter),
- `sf-cache-no-tag-get` - run all tests which bench getting cache item with Symfony Cache Component usage (only standard adapter),
- `sf-cache-no-tag-save` - run all tests which bench saving cache item with Symfony Cache Component usage (only standard adapter),
- `sf-cache-no-tag-get` - run all tests which bench getting cache item with Symfony Cache Component usage (only tag aware adapter),
- `sf-cache-no-tag-save` - run all tests which bench saving cache item with Symfony Cache Component usage (only tag aware adapter),

## Example results

### Pure string (direct client)

Gets one value from 1000 created test keys in Redis.

`php vendor/bin/phpbench run --report=aggregate --group=get-string`

```
Subjects: 2, Assertions: 0, Failures: 0, Errors: 0
+-----------+------------------------------------+-----+------+-----+-----------+-----------+--------+
| benchmark | subject                            | set | revs | its | mem_peak  | mode      | rstdev |
+-----------+------------------------------------+-----+------+-----+-----------+-----------+--------+
| GetBench  | benchPhpRedisClusterGetStringValue |     | 50   | 50  | 815.448kb | 287.975μs | ±7.28% |
| GetBench  | benchPredisClusterGetStringValue   |     | 50   | 50  | 1.867mb   | 429.968μs | ±8.69% |
+-----------+------------------------------------+-----+------+-----+-----------+-----------+--------+
```

Sets one key with value to Redis.

`php vendor/bin/phpbench run --report=aggregate --group=set-string`

```
Subjects: 2, Assertions: 0, Failures: 0, Errors: 0
+-----------+------------------------------------+-----+------+-----+----------+-----------+--------+
| benchmark | subject                            | set | revs | its | mem_peak | mode      | rstdev |
+-----------+------------------------------------+-----+------+-----+----------+-----------+--------+
| SetBench  | benchPhpRedisClusterSetStringValue |     | 100  | 10  | 2.585mb  | 473.153μs | ±4.26% |
| SetBench  | benchPredisClusterSetStringValue   |     | 100  | 10  | 4.442mb  | 601.873μs | ±7.10% |
+-----------+------------------------------------+-----+------+-----+----------+-----------+--------+
```

### Symfony Cache Component

For each test the Fake huge object has been passed as value to check performance of serialization and deserialization. 

Gets one value from 1000 created test keys in Redis with usage of standard Symfony Cache Component Redis adapter.

`php vendor/bin/phpbench run --report=aggregate --group=sf-cache-no-tag-get`

```
Subjects: 2, Assertions: 0, Failures: 0, Errors: 0
+-----------+-------------------------------------+-----+------+-----+----------+-----------+--------+
| benchmark | subject                             | set | revs | its | mem_peak | mode      | rstdev |
+-----------+-------------------------------------+-----+------+-----+----------+-----------+--------+
| GetBench  | benchPhpRedisClusterSymfonyCacheGet |     | 50   | 50  | 10.992mb | 793.533μs | ±6.24% |
| GetBench  | benchPredisClusterSymfonyCacheGet   |     | 50   | 50  | 5.116mb  | 833.657μs | ±5.77% |
+-----------+-------------------------------------+-----+------+-----+----------+-----------+--------+
```

Sets one key with value to Redis with usage of standard Symfony Cache Component Redis adapter.

`php vendor/bin/phpbench run --report=aggregate --group=sf-cache-no-tag-save`

```
Subjects: 2, Assertions: 0, Failures: 0, Errors: 0
+-----------+--------------------------------------+-----+------+-----+----------+-----------+--------+
| benchmark | subject                              | set | revs | its | mem_peak | mode      | rstdev |
+-----------+--------------------------------------+-----+------+-----+----------+-----------+--------+
| SaveBench | benchPhpRedisClusterSymfonyCacheSave |     | 50   | 50  | 23.933mb | 760.875μs | ±6.32% |
| SaveBench | benchPredisClusterSymfonyCacheSave   |     | 50   | 50  | 18.230mb | 818.965μs | ±5.60% |
+-----------+--------------------------------------+-----+------+-----+----------+-----------+--------+
```

Gets one value from 1000 created test keys in Redis with usage of Symfony Cache Component Redis Tag Aware adapter.

`php vendor/bin/phpbench run --report=aggregate --group=sf-cache-tag-get`

```
Subjects: 2, Assertions: 0, Failures: 0, Errors: 0
+-----------+----------------------------------------+-----+------+-----+----------+---------+--------+
| benchmark | subject                                | set | revs | its | mem_peak | mode    | rstdev |
+-----------+----------------------------------------+-----+------+-----+----------+---------+--------+
| GetBench  | benchPhpRedisClusterSymfonyCacheTagGet |     | 50   | 50  | 11.052mb | 1.342ms | ±5.19% |
| GetBench  | benchPredisClusterSymfonyCacheTagGet   |     | 50   | 50  | 6.026mb  | 1.714ms | ±4.83% |
+-----------+----------------------------------------+-----+------+-----+----------+---------+--------+
```

Sets one key with value to Redis with usage of Symfony Cache Component Redis Tag Aware adapter.

`php vendor/bin/phpbench run --report=aggregate --group=sf-cache-tag-save`

```
Subjects: 2, Assertions: 0, Failures: 0, Errors: 0
+-----------+-----------------------------------------+-----+------+-----+----------+---------+--------+
| benchmark | subject                                 | set | revs | its | mem_peak | mode    | rstdev |
+-----------+-----------------------------------------+-----+------+-----+----------+---------+--------+
| SaveBench | benchPhpRedisClusterSymfonyCacheTagSave |     | 50   | 50  | 24.151mb | 1.557ms | ±7.56% |
| SaveBench | benchPredisClusterSymfonyCacheTagSave   |     | 50   | 50  | 19.141mb | 1.890ms | ±9.64% |
+-----------+-----------------------------------------+-----+------+-----+----------+---------+--------+
```
