<?php
namespace CookieTime\Janitor\Enums;

class ResourceSupportedRequestMethods
{
    const PREFIX = 'supported_request_methods_';

    const POST = self::PREFIX.'post';// post
    const PUT = self::PREFIX.'put';// put
    const GET = self::PREFIX.'get';// get
    const DELETE = self::PREFIX.'delete';// delete
}