<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Phân Bón Hưu Cơ Cao Cấp - Công Ty TNHH Phân Bón Quốc Tế Rồng Xanh">
    <meta name="keywords" content="Phân Bón Hưu Cơ, Phân Bón Quốc Tế, Phân Bón Rồng Xanh, Phân Bón Hữu Cơ Cao Cấp">
    <meta name="author" content="Công Ty TNHH Phân Bón Quốc Tế Rồng Xanh">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta name="google-site-verification" content="34jAURi3G-Cy3eMcW_9Y2WC_gCePy0CjJESnJhKuQ9g" />
    <link rel="icon" href="{{ url('/assets/logo123123-removebg-preview-removebg-preview.png') }}" type="image/x-icon">
    <style>
        @font-face {
            font-family: 'FLIcons';
            src:
                url('/assets/fl-icons.woff') format('woff'),
                url('/assets/fl-icons.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
    </style>
    @livewireStyles <!-- Thêm dòng này để load styles cho Livewire -->
</head>
<body>

    @livewire('header') <!-- Nhúng component header ở đây -->

    {{ $slot }} <!-- Nội dung chính của trang -->
    @livewire('footer') <!-- Nhúng component footer ở đây -->

    @livewireScripts <!-- Thêm dòng này để load scripts cho Livewire -->
    <style>
        select.gt_selector.notranslate {
    display: none;
}
    </style>
</body>
</html>