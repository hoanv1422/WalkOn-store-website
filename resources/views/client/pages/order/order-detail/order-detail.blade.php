    <div class="spee__main-wrapper">
        <!-- Header -->
        <div class="spee__top-nav">
            <a href="/order-list" class="spee__return-link">
                <svg viewBox="0 0 24 24" width="18" height="18">
                    <path fill="currentColor" d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z">
                    </path>
                </svg>
                TRỞ LẠI
            </a>
            <div class="spee__order-id-badge">
                MÃ ĐƠN HÀNG: <span id="order-detail-code"></span> | <span id="order-detail-status"></span>
            </div>
        </div>

        <!-- Progress Tracker -->
        <div class="spee__flow-visualizer">
            <div class="spee__progress-connector"></div>
            <div class="spee__flow-stages">
                <div class="spee__milestone" data-status="pending">
                    <div class="spee__milestone-bubble">
                        <svg viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M19,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3M19,19H5V5H19V19M17,17H7V7H17V17Z">
                            </path>
                        </svg>
                    </div>
                    <div class="spee__milestone-label">Đơn Hàng Đã Đặt</div>
                    <div class="spee__milestone-timestamp">01:04 12-12-2024</div>
                </div>
                <div class="spee__milestone" data-status="confirmed,processing,ready,picking_up">
                    <div class="spee__milestone-bubble">
                        <svg viewBox="0 0 24 24">
                            <path fill="currentColor" d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z">
                            </path>
                        </svg>
                    </div>
                    <div class="spee__milestone-label">Đã Xác Nhận Thanh Toán</div>
                    <div class="spee__milestone-timestamp"></div>
                </div>
                <div class="spee__milestone" data-status="shipping">
                    <div class="spee__milestone-bubble">
                        <svg viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M18,18.5A1.5,1.5 0 0,1 16.5,17A1.5,1.5 0 0,1 18,15.5A1.5,1.5 0 0,1 19.5,17A1.5,1.5 0 0,1 18,18.5M19.5,9.5L21.46,12H17V9.5M6,18.5A1.5,1.5 0 0,1 4.5,17A1.5,1.5 0 0,1 6,15.5A1.5,1.5 0 0,1 7.5,17A1.5,1.5 0 0,1 6,18.5M20,8H17V4H3C1.89,4 1,4.89 1,6V17H3A3,3 0 0,0 6,20A3,3 0 0,0 9,17H15A3,3 0 0,0 18,20A3,3 0 0,0 21,17H23V12L20,8Z">
                            </path>
                        </svg>
                    </div>
                    <div class="spee__milestone-label">Đã Giao Cho ĐVVC</div>
                    <div class="spee__milestone-timestamp"></div>
                </div>
                <div class="spee__milestone" data-status="delivered">
                    <div class="spee__milestone-bubble">
                        <svg viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M20,8H4V6H20M20,18H4V12H20M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z">
                            </path>
                        </svg>
                    </div>
                    <div class="spee__milestone-label">Đã Nhận Được Hàng</div>
                    <div class="spee__milestone-timestamp"></div>
                </div>
                <div class="spee__milestone" data-status="completed">
                    <div class="spee__milestone-bubble">
                        <svg viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z">
                            </path>
                        </svg>
                    </div>
                    <div class="spee__milestone-label">Đơn Hàng Đã Hoàn Thành</div>
                    <div class="spee__milestone-timestamp">22:59 17-01-2025</div>
                </div>
            </div>
        </div>

        <!-- Delivery Information -->
        <div class="spee__shipment-details">
            <h3 class="spee__block-heading">Địa Chỉ Nhận Hàng</h3>
            <div class="spee__recipient-info">
                {{-- Address --}}
            </div>
        </div>

        <!-- Product Information -->
        <div class="spee__item-details">
            {{-- Items --}}
        </div>

        <!-- Price Summary -->
        <div class="spee__cost-breakdown">
            {{-- Price --}}
        </div>


        <!-- Payment Method -->
        <div class="spee__payment-info">
          
        </div>
    </div>
