# error-ding
laravel 将handler里面的错误消息发送到dingTalk

# 使用方法
推荐放在larave handler里面的report函数中，（最好是在shouldntReport后面）


> ` if ($handler = ErrorDing::channel(配置文件路径默认'self.error_handler')) {  `  
>    ` $handler->errorMsg($exception);   `
> ` } `

# 配置文件

*   token dingTalk的机器人token
*   error_log 如果指定这个配置项，那么会把Exception的trace信息存储在这个文件里面
*   open 是否打开推送
*   env  只允许在env环境里面报警，默认是production
