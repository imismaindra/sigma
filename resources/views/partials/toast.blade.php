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
            top: 24px;
            right: 24px;
            z-index: 9999;
            display: grid;
            gap: 12px;
            width: min(400px, calc(100vw - 48px));
            pointer-events: none;
        }

        .sipma-toast {
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 14px;
            align-items: flex-start;
            padding: 16px;
            border-radius: 16px;
            border: 1px solid rgba(226, 232, 240, 0.8);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            color: #0f172a;
            box-shadow: 0 20px 48px rgba(15, 23, 42, 0.08);
            transform: translateY(-16px);
            opacity: 0;
            pointer-events: auto;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.3s ease;
        }

        .sipma-toast.is-visible {
            transform: translateY(0);
            opacity: 1;
        }

        .sipma-toast-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }

        .sipma-toast-success { border-color: rgba(22, 163, 74, 0.2); }
        .sipma-toast-success .sipma-toast-icon { background: #f0fdf4; color: #16a34a; }

        .sipma-toast-error { border-color: rgba(220, 38, 38, 0.2); }
        .sipma-toast-error .sipma-toast-icon { background: #fef2f2; color: #dc2626; }

        .sipma-toast-warning { border-color: rgba(217, 119, 6, 0.2); }
        .sipma-toast-warning .sipma-toast-icon { background: #fffbeb; color: #d97706; }

        .sipma-toast-info { border-color: rgba(79, 70, 229, 0.2); }
        .sipma-toast-info .sipma-toast-icon { background: #eeebff; color: #4f46e5; }

        .sipma-toast-title {
            display: block;
            margin-bottom: 4px;
            font-size: 13.5px;
            font-weight: 800;
            color: #0f172a;
        }

        .sipma-toast-message {
            color: #64748b;
            font-size: 12.5px;
            line-height: 1.5;
        }

        .sipma-toast-close {
            width: 26px;
            height: 26px;
            border: 0;
            border-radius: 8px;
            background: #f8fafc;
            color: #64748b;
            cursor: pointer;
            font-size: 18px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .sipma-toast-close:hover {
            background: #cbd5e1;
            color: #0f172a;
        }

        @media (max-width: 640px) {
            .sipma-toast-stack {
                top: 16px;
                right: 16px;
                left: 16px;
                width: auto;
            }
        }
    </style>

    <div class="sipma-toast-stack" aria-live="polite" aria-atomic="true">
        @foreach($toastMessages as $toast)
            @php
                $lucideIcon = [
                    'success' => 'check-circle',
                    'error' => 'alert-octagon',
                    'warning' => 'alert-triangle',
                    'info' => 'info',
                ][$toast['type']] ?? 'info';
            @endphp
            <div class="sipma-toast sipma-toast-{{ $toast['type'] }}" role="alert">
                <div class="sipma-toast-icon" aria-hidden="true">
                    <i data-lucide="{{ $lucideIcon }}" class="w-5 h-5"></i>
                </div>
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
                const hideToast = () => {
                    toast.classList.remove('is-visible');
                    setTimeout(() => toast.remove(), 300);
                };

                window.setTimeout(() => toast.classList.add('is-visible'), 100 + (index * 80));
                close?.addEventListener('click', hideToast);
                window.setTimeout(hideToast, 5200 + (index * 400));
            });
        })();
    </script>
@endif
