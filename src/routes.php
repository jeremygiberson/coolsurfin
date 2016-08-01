<?php
// Routes
use Coolsurfin\Routes\IndexRoute;
use Coolsurfin\Routes\NewCommentRoute;
use Coolsurfin\Routes\PostRoute;

$app->get('/', IndexRoute::class)->setName('home');
$app->get('/post/{id}', PostRoute::class)->setName('post');

$app->post('/post/create', NewCommentRoute::class)->setName('new_comment');
