<x-boilerplate>
    @if (auth()->user()->role === 'buyer')
        <x-buyerchat :chats="$chats">
            <!-- Chat Window -->
            <div class="flex-1 flex flex-col bg-gray-50 w-full">
                @php
                    $otherUser = $chat->users->first();
                @endphp

                <!-- Chat Header -->
                <div class="px-4 sm:px-6 lg:px-8 py-4 sm:py-5 bg-white border-b">
                    <div class="flex items-center gap-3">
                        <img src="{{ $otherUser->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($otherUser->name) }}"
                            alt="{{ $otherUser->name }}" class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">{{ $otherUser->name }}</h2>
                            <p class="text-xs sm:text-sm text-green-600">
                                {{ $otherUser->business_type ?? 'Vendor' }}
                                @if ($otherUser->location)
                                    · {{ $otherUser->location }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Messages Area -->
                <div id="messagesArea"
                    class="flex-1 overflow-y-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 space-y-4 sm:space-y-6">

                    @php
                        $previousDate = null;
                    @endphp

                    @forelse($messages as $message)
                        @php
                            $messageDate = $message->created_at->format('Y-m-d');
                            $showDateDivider = $previousDate !== $messageDate;
                            $previousDate = $messageDate;
                            $isSender = $message->sender_id === auth()->id();
                        @endphp

                        @if ($showDateDivider)
                            <!-- Date Divider -->
                            <div class="flex items-center justify-center my-4">
                                <div class="flex-1 border-t border-gray-200"></div>
                                <span class="px-4 text-xs text-gray-500 font-medium">
                                    @if ($message->created_at->isToday())
                                        Today
                                    @elseif($message->created_at->isYesterday())
                                        Yesterday
                                    @else
                                        {{ $message->created_at->format('d F Y') }}
                                    @endif
                                </span>
                                <div class="flex-1 border-t border-gray-200"></div>
                            </div>
                        @endif

                        @if ($isSender)
                            <!-- Sent Message -->
                            <div class="flex flex-col items-end max-w-2xl ml-auto">
                                <div
                                    class="bg-green-600 text-white rounded-2xl rounded-tr-sm shadow-sm {{ $message->hasAttachment() ? 'p-2' : 'px-5 py-3' }}">
                                    @if ($message->hasAttachment())
                                        @if ($message->isImage())
                                            <img src="{{ $message->attachmentUrl }}" alt="Attachment"
                                                class="rounded-lg max-w-full h-auto max-h-96 object-contain">
                                            @if ($message->message && $message->message !== 'Sent an attachment')
                                                <p class="text-xs mt-2 px-2">{{ $message->message }}</p>
                                            @endif
                                        @else
                                            <div class="flex items-center gap-3 px-3 py-2">
                                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-medium">{{ basename($message->attachment) }}
                                                    </p>
                                                    <a href="{{ $message->attachmentUrl }}" download
                                                        class="text-xs text-green-100 hover:underline">Download</a>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <p class="text-sm">{{ $message->message }}</p>
                                    @endif
                                </div>
                                <div class="flex items-center gap-2 mt-1 mr-2">
                                    <span
                                        class="text-xs text-gray-400">{{ $message->created_at->format('H:i') }}</span>
                                    @php
                                        $isRead =
                                            $otherUserLastReadMessageId && $message->id <= $otherUserLastReadMessageId;
                                    @endphp
                                    <svg class="w-4 h-4 {{ $isRead ? 'text-green-600' : 'text-gray-400' }}"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                @if ($isRead)
                                    <span class="text-xs text-green-600 mt-1 mr-2 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Read
                                    </span>
                                @endif
                            </div>
                        @else
                            <!-- Received Message -->
                            <div class="flex flex-col items-start max-w-2xl">
                                <div
                                    class="bg-white rounded-2xl rounded-tl-sm shadow-sm {{ $message->hasAttachment() ? 'p-2' : 'px-5 py-3' }}">
                                    @if ($message->hasAttachment())
                                        @if ($message->isImage())
                                            <img src="{{ $message->attachmentUrl }}" alt="Attachment"
                                                class="rounded-lg max-w-full h-auto max-h-96 object-contain">
                                            @if ($message->message && $message->message !== 'Sent an attachment')
                                                <p class="text-xs text-gray-700 mt-2 px-2">{{ $message->message }}</p>
                                            @endif
                                        @else
                                            <div class="flex items-center gap-3 px-3 py-2">
                                                <svg class="w-8 h-8 text-gray-700" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-800">
                                                        {{ basename($message->attachment) }}</p>
                                                    <a href="{{ $message->attachmentUrl }}" download
                                                        class="text-xs text-green-600 hover:underline">Download</a>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <p class="text-sm text-gray-800">{{ $message->message }}</p>
                                    @endif
                                </div>
                                <div class="flex items-center gap-2 mt-1 ml-2">
                                    <span
                                        class="text-xs text-gray-400">{{ $message->created_at->format('H:i') }}</span>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="flex flex-col items-center justify-center h-full text-gray-500">
                            <svg class="w-20 h-20 mb-4 text-gray-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                            <p class="text-lg font-medium mb-2">No messages yet</p>
                            <p class="text-sm">Start the conversation by sending a message below</p>
                        </div>
                    @endforelse
                </div>

                <!-- Message Input -->
                <div class="bg-white border-t border-gray-200 px-4 sm:px-6 lg:px-8 py-3 sm:py-4">
                    <form action="{{ route('chats.sendMessage', $chat->slug) }}" method="POST"
                        enctype="multipart/form-data" id="messageForm">
                        @csrf
                        <div class="flex items-center gap-2 sm:gap-3">
                            <div class="flex-1 relative">
                                <input type="text" name="message" id="messageInput"
                                    placeholder="Type your message..."
                                    class="w-full px-3 sm:px-4 py-2 sm:py-3 bg-green-50 border-0 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 pr-10 sm:pr-12">
                                <input type="file" name="attachment" id="fileInput" class="hidden"
                                    accept="image/*,.pdf,.doc,.docx,.txt">
                                <button type="button" id="attachFileBtn"
                                    class="absolute right-2 sm:right-3 top-2 sm:top-3 text-green-600 hover:text-green-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            <button type="submit" id="sendMessageBtn"
                                class="px-4 sm:px-6 py-2 sm:py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition-colors text-sm">
                                Send
                            </button>
                        </div>
                        <div id="filePreview" class="mt-2 hidden">
                            <div class="flex items-center gap-2 bg-gray-100 px-3 py-2 rounded-lg">
                                <span id="fileName" class="text-sm text-gray-700"></span>
                                <button type="button" id="removeFile" class="text-red-500 hover:text-red-700">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @error('message')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        @error('attachment')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </form>
                </div>
            </div>
        </x-buyerchat>
    @elseif (auth()->user()->role === 'vendor')
        <x-vendorchat :chats="$chats">
            <!-- Chat Window -->
            <div class="flex-1 flex flex-col bg-gray-50 w-full">
                @php
                    $otherUser = $chat->users->first();
                @endphp

                <!-- Chat Header -->
                <div class="px-4 sm:px-6 lg:px-8 py-4 sm:py-5 bg-white border-b">
                    <div class="flex items-center gap-3">
                        <img src="{{ $otherUser->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($otherUser->name) }}"
                            alt="{{ $otherUser->name }}" class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">{{ $otherUser->name }}</h2>
                            <p class="text-xs sm:text-sm text-green-600">
                                {{ $otherUser->business_type ?? 'Buyer' }}
                                @if ($otherUser->location)
                                    · {{ $otherUser->location }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Messages Area -->
                <div id="messagesArea"
                    class="flex-1 overflow-y-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 space-y-4 sm:space-y-6">

                    @php
                        $previousDate = null;
                    @endphp

                    @forelse($messages as $message)
                        @php
                            $messageDate = $message->created_at->format('Y-m-d');
                            $showDateDivider = $previousDate !== $messageDate;
                            $previousDate = $messageDate;
                            $isSender = $message->sender_id === auth()->id();
                        @endphp

                        @if ($showDateDivider)
                            <!-- Date Divider -->
                            <div class="flex items-center justify-center my-4">
                                <div class="flex-1 border-t border-gray-200"></div>
                                <span class="px-4 text-xs text-gray-500 font-medium">
                                    @if ($message->created_at->isToday())
                                        Today
                                    @elseif($message->created_at->isYesterday())
                                        Yesterday
                                    @else
                                        {{ $message->created_at->format('d F Y') }}
                                    @endif
                                </span>
                                <div class="flex-1 border-t border-gray-200"></div>
                            </div>
                        @endif

                        @if ($isSender)
                            <!-- Sent Message -->
                            <div class="flex flex-col items-end max-w-2xl ml-auto">
                                <div
                                    class="bg-green-600 text-white rounded-2xl rounded-tr-sm shadow-sm {{ $message->hasAttachment() ? 'p-2' : 'px-5 py-3' }}">
                                    @if ($message->hasAttachment())
                                        @if ($message->isImage())
                                            <img src="{{ $message->attachmentUrl }}" alt="Attachment"
                                                class="rounded-lg max-w-full h-auto max-h-96 object-contain">
                                            @if ($message->message && $message->message !== 'Sent an attachment')
                                                <p class="text-xs mt-2 px-2">{{ $message->message }}</p>
                                            @endif
                                        @else
                                            <div class="flex items-center gap-3 px-3 py-2">
                                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-medium">
                                                        {{ basename($message->attachment) }}</p>
                                                    <a href="{{ $message->attachmentUrl }}" download
                                                        class="text-xs text-green-100 hover:underline">Download</a>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <p class="text-sm">{{ $message->message }}</p>
                                    @endif
                                </div>
                                <div class="flex items-center gap-2 mt-1 mr-2">
                                    <span
                                        class="text-xs text-gray-400">{{ $message->created_at->format('H:i') }}</span>
                                    <svg class="w-4 h-4 {{ $message->is_read ? 'text-green-600' : 'text-gray-400' }}"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                @if ($message->is_read)
                                    <span class="text-xs text-green-600 mt-1 mr-2 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Read
                                    </span>
                                @endif
                            </div>
                        @else
                            <!-- Received Message -->
                            <div class="flex flex-col items-start max-w-2xl">
                                <div
                                    class="bg-white rounded-2xl rounded-tl-sm shadow-sm {{ $message->hasAttachment() ? 'p-2' : 'px-5 py-3' }}">
                                    @if ($message->hasAttachment())
                                        @if ($message->isImage())
                                            <img src="{{ $message->attachmentUrl }}" alt="Attachment"
                                                class="rounded-lg max-w-full h-auto max-h-96 object-contain">
                                            @if ($message->message && $message->message !== 'Sent an attachment')
                                                <p class="text-xs text-gray-700 mt-2 px-2">{{ $message->message }}</p>
                                            @endif
                                        @else
                                            <div class="flex items-center gap-3 px-3 py-2">
                                                <svg class="w-8 h-8 text-gray-700" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-800">
                                                        {{ basename($message->attachment) }}</p>
                                                    <a href="{{ $message->attachmentUrl }}" download
                                                        class="text-xs text-green-600 hover:underline">Download</a>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <p class="text-sm text-gray-800">{{ $message->message }}</p>
                                    @endif
                                </div>
                                <div class="flex items-center gap-2 mt-1 ml-2">
                                    <span
                                        class="text-xs text-gray-400">{{ $message->created_at->format('H:i') }}</span>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="flex flex-col items-center justify-center h-full text-gray-500">
                            <svg class="w-20 h-20 mb-4 text-gray-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                            <p class="text-lg font-medium mb-2">No messages yet</p>
                            <p class="text-sm">Start the conversation by sending a message below</p>
                        </div>
                    @endforelse
                </div>

                <!-- Message Input -->
                <div class="bg-white border-t border-gray-200 px-4 sm:px-6 lg:px-8 py-3 sm:py-4">
                    <form action="{{ route('chats.sendMessage', $chat->slug) }}" method="POST"
                        enctype="multipart/form-data" id="messageForm">
                        @csrf
                        <div class="flex items-center gap-2 sm:gap-3">
                            <div class="flex-1 relative">
                                <input type="text" name="message" id="messageInput"
                                    placeholder="Type your message..."
                                    class="w-full px-3 sm:px-4 py-2 sm:py-3 bg-green-50 border-0 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 pr-10 sm:pr-12">
                                <input type="file" name="attachment" id="fileInput" class="hidden"
                                    accept="image/*,.pdf,.doc,.docx,.txt">
                                <button type="button" id="attachFileBtn"
                                    class="absolute right-2 sm:right-3 top-2 sm:top-3 text-green-600 hover:text-green-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            <button type="submit" id="sendMessageBtn"
                                class="px-4 sm:px-6 py-2 sm:py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition-colors text-sm">
                                Send
                            </button>
                        </div>
                        <div id="filePreview" class="mt-2 hidden">
                            <div class="flex items-center gap-2 bg-gray-100 px-3 py-2 rounded-lg">
                                <span id="fileName" class="text-sm text-gray-700"></span>
                                <button type="button" id="removeFile" class="text-red-500 hover:text-red-700">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @error('message')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        @error('attachment')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </form>
                </div>
            </div>
        </x-vendorchat>
    @endif

    <script>
        // File upload handling
        const fileInput = document.getElementById('fileInput');
        const attachFileBtn = document.getElementById('attachFileBtn');
        const filePreview = document.getElementById('filePreview');
        const fileName = document.getElementById('fileName');
        const removeFile = document.getElementById('removeFile');
        const messageInput = document.getElementById('messageInput');
        const messageForm = document.getElementById('messageForm');
        const messagesArea = document.getElementById('messagesArea');

        // Scroll to bottom on load
        if (messagesArea) {
            messagesArea.scrollTop = messagesArea.scrollHeight;
        }

        // Attach file button
        if (attachFileBtn) {
            attachFileBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                if (fileInput) {
                    fileInput.click();
                }
            });
        }

        // File selection
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    fileName.textContent = file.name;
                    filePreview.classList.remove('hidden');
                    // Make message optional when file is attached
                    if (messageInput) {
                        messageInput.removeAttribute('required');
                    }
                }
            });
        }

        // Remove file
        if (removeFile) {
            removeFile.addEventListener('click', function(e) {
                e.preventDefault();
                if (fileInput) {
                    fileInput.value = '';
                }
                if (filePreview) {
                    filePreview.classList.add('hidden');
                }
                // Make message required again if no file
                if (messageInput) {
                    messageInput.setAttribute('required', 'required');
                }
            });
        }

        // Auto-scroll to bottom when new messages arrive
        if (messagesArea) {
            const observer = new MutationObserver(() => {
                messagesArea.scrollTop = messagesArea.scrollHeight;
            });

            observer.observe(messagesArea, {
                childList: true,
                subtree: true
            });
        }

        // Mark messages as read when viewing
        @if (isset($unreadMessages) && $unreadMessages->count() > 0)
            fetch('{{ route('chats.markAsRead', $chat->slug) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            }).catch(error => console.error('Error marking messages as read:', error));
        @endif

        document.addEventListener("DOMContentLoaded", function() {
            const chatSlug = "{{ $chat->slug }}";

            fetch(`/chats/${chatSlug}/messages/read`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                            "content"),
                        "Accept": "application/json",
                    },
                }).then(response => response.json())
                .then(data => {
                    console.log("Messages marked as read:", data);
                })
                .catch(console.error);
        });
    </script>
</x-boilerplate>
