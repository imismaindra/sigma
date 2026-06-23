@php
    $toastMessages = collect();

    foreach (['success', 'error', 'warning', 'info', 'status'] as $toastType) {
        if (session($toastType)) {
            $toastMessages->push([
                'type' => $toastType === 'status' ? 'info' : $toastType,
                'title' => [
                    'success' => 'Berhasil',
                    'error' => 'Terjadi Kendala',
                    'warning' => 'Perhatian',
                    'info' => 'Informasi',
                    'status' => 'Informasi',
                ][$toastType],
                'message' => session($toastType),
            ]);
        }
    }

    if ($errors->any()) {
        $toastMessages->push([
            'type' => 'error',
            'title' => 'Data belum valid',
            'message' => $errors->first(),
        ]);
    }
@endphp

@if($toastMessages->isNotEmpty())
    <style>
        .sipma-toast-stack {
            position: fixed;
            top: 18px;
            right: 18px;
            z-index: 9999;
            display: grid;
            gap: 10px;
            width: min(390px, calc(100vw - 32px));
            pointer-events: none;
        }

        .sipma-toast {
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 12px;
            align-items: flex-start;
            padding: 14px;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            color: #0f172a;
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.16);
            transform: translateY(-10px);
            opacity: 0;
            pointer-events: auto;
            transition: transform 0.22s ease, opacity 0.22s ease;
        }

        .sipma-toast.is-visible {
            transform: translateY(0);
            opacity: 1;
        }

        .sipma-toast-icon {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            font-size: 15px;
            font-weight: 800;
        }

        .sipma-toast-success { border-color: #bbf7d0; }
        .sipma-toast-success .sipma-toast-icon { background: #f0fdf4; color: #15803d; }

        .sipma-toast-error { border-color: #fecaca; }
        .sipma-toast-error .sipma-toast-icon { background: #fef2f2; color: #dc2626; }

        .sipma-toast-warning { border-color: #fde68a; }
        .sipma-toast-warning .sipma-toast-icon { background: #fffbeb; color: #d97706; }

        .sipma-toast-info { border-color: #bfdbfe; }
        .sipma-toast-info .sipma-toast-icon { background: #eff6ff; color: #2563eb; }

        .sipma-toast-title {
            display: block;
            margin-bottom: 4px;
            font-size: 13px;
            font-weight: 800;
        }

        .sipma-toast-message {
            color: #64748b;
            font-size: 13px;
            line-height: 1.45;
        }

        .sipma-toast-close {
            width: 28px;
            height: 28px;
            border: 0;
            border-radius: 8px;
            background: #f8fafc;
            color: #64748b;
            cursor: pointer;
            font-size: 18px;
            line-height: 1;
        }

        .sipma-toast-close:hover {
            background: #eef2f7;
            color: #0f172a;
        }

        @media (max-width: 640px) {
            .sipma-toast-stack {
                top: 12px;
                right: 12px;
                left: 12px;
                width: auto;
            }
        }
    </style>

    <div class="sipma-toast-stack" aria-live="polite" aria-atomic="true">
        @foreach($toastMessages as $toast)
            @php
                $icon = [
                    'success' => '✓',
                    'error' => '!',
                    'warning' => '!',
                    'info' => 'i',
                ][$toast['type']] ?? 'i';
            @endphp
            <div class="sipma-toast sipma-toast-{{ $toast['type'] }}" role="alert">
                <div class="sipma-toast-icon" aria-hidden="true">{{ $icon }}</div>
                <div>
                    <span class="sipma-toast-title">{{ $toast['title'] }}</span>
                    <div class="sipma-toast-message">{{ $toast['message'] }}</div>
                </div>
                <button type="button" class="sipma-toast-close" aria-label="Tutup notifikasi">&times;</button>
            </div>
        @endforeach
    </div>

    <script>
        (() => {
            document.querySelectorAll('.sipma-toast').forEach((toast, index) => {
                const close = toast.querySelector('.sipma-toast-close');
                const hideToast = () => toast.classList.remove('is-visible');

                window.setTimeout(() => toast.classList.add('is-visible'), 100 + (index * 80));
                close?.addEventListener('click', hideToast);
                window.setTimeout(hideToast, 5200 + (index * 400));
            });
        })();
    </script>
@endif
