## 开始

* 不要安装 `phalcon/devtools` 因为有 bug
* 如果使用 phpStorm IDE，可以安装 `phalcon 5` 插件。

```
data/ 数据目录 —— 需要手动创建
    |-- mysql
    |-- pgsql
    |-- redis
log/ 日志目录 —— 需要手动创建
    |-- mysql
    |-- nginx
    |-- php
php/
    |-- extra.ini PHP 配置文件，可根据需要修改
src/ 项目目录
    |-- myapp 单模块示例
    |-- mymodules 多模块示例
```

本地测试时，可以通过修改 `nginx/default.conf` 中的 `root` 路径来进行项目测试，默认启动的是 `src/mymodules` 多模块目录；

## 资源

* [phalcon doc](https://docs.phalcon.io/5.0/zh-cn/tutorial-basic)
* [awesome phalcon](https://github.com/phalcon/awesome-phalcon)
* [Docker](https://github.com/phalcon/docker)