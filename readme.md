# pg direct

```shell
ab -c 100 -n 10000 localhost:8081/doctrine/persister
```

```
Requests per second:    715.86 [#/sec] (mean)
Time per request:       139.692 [ms] (mean)
Time per request:       1.397 [ms] (mean, across all concurrent requests)
```

```shell
ab -c 100 -n 10000 localhost:8081/doctrine/connection
```

```
Requests per second:    701.48 [#/sec] (mean)
Time per request:       142.555 [ms] (mean)
Time per request:       1.426 [ms] (mean, across all concurrent requests)
```

# pgpool

```shell
ab -c 100 -n 10000 localhost:8081/doctrine/persister
```

```
Requests per second:    846.26 [#/sec] (mean)
Time per request:       118.167 [ms] (mean)
Time per request:       1.182 [ms] (mean, across all concurrent requests)
```

```shell
ab -c 100 -n 10000 localhost:8081/doctrine/connection
```

```
Requests per second:    1347.91 [#/sec] (mean)
Time per request:       74.189 [ms] (mean)
Time per request:       0.742 [ms] (mean, across all concurrent requests)
```
