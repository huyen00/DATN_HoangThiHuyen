<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="locale" content="<?php echo e(App::getLocale()); ?>" />
    <base href="<?php echo e(asset('')); ?>">
    <link rel="icon" href="/static/img/favicon.png">
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="/static/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/static/css/skin-blue.min.css">
    <link rel="stylesheet" href="/static/js/plugins/pace/pace.min.css">
    
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="<?php echo e(mix('/css/app.css')); ?>" rel="stylesheet" />

    <script src="<?php echo e(mix('/js/app.js')); ?>" defer></script>

    <?php echo app('Tightenco\Ziggy\BladeRouteGenerator')->generate(); ?>
    <?php if (!isset($__inertiaSsr)) { $__inertiaSsr = app(\Inertia\Ssr\Gateway::class)->dispatch($page); }  if ($__inertiaSsr instanceof \Inertia\Ssr\Response) { echo $__inertiaSsr->head; } ?>
  </head>

  <body class=" hold-transition skin-blue sidebar-mini" style="overflow-y:scroll">
    <?php if (!isset($__inertiaSsr)) { $__inertiaSsr = app(\Inertia\Ssr\Gateway::class)->dispatch($page); }  if ($__inertiaSsr instanceof \Inertia\Ssr\Response) { echo $__inertiaSsr->body; } else { ?><div id="app" data-page="<?php echo e(json_encode($page)); ?>"></div><?php } ?>
    <script src="/static/js/plugins/jQuery/jQuery-2.2.0.min.js"></script>
    <script src="/static/js/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="/static/js/plugins/AdminLTE/app.min.js"></script>
    <script src="/static/js/plugins/pace/pace.min.js"></script>
    <script src="//d2wy8f7a9ursnm.cloudfront.net/v4/bugsnag.min.js"></script>
    <script src="//d2wy8f7a9ursnm.cloudfront.net/bugsnag-plugins/v1/bugsnag-vue.min.js"></script>

  </body>
</html>
<?php /**PATH C:\xampp\htdocs\Holo360\resources\views\app.blade.php ENDPATH**/ ?>