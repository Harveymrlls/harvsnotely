                                                                                                                    // JS FOR APP.PHP

// Mobile menu functionality
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');

    mobileMenuButton.addEventListener('click', function() {
const isHidden = mobileMenu.classList.contains('hidden');

if (isHidden) {
    // Show menu
    mobileMenu.classList.remove('hidden');
    mobileMenu.classList.add('block');
    menuIcon.classList.remove('fa-bars');
    menuIcon.classList.add('fa-times');
} else {
    // Hide menu
    mobileMenu.classList.add('hidden');
    mobileMenu.classList.remove('block');
    menuIcon.classList.remove('fa-times');
    menuIcon.classList.add('fa-bars');
}
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
const isClickInsideMenu = mobileMenu.contains(event.target);
const isClickOnButton = mobileMenuButton.contains(event.target);

if (!isClickInsideMenu && !isClickOnButton && !mobileMenu.classList.contains('hidden')) {
    mobileMenu.classList.add('hidden');
    mobileMenu.classList.remove('block');
    menuIcon.classList.remove('fa-times');
    menuIcon.classList.add('fa-bars');
}
    });

    // Close mobile menu when window is resized to desktop size
    window.addEventListener('resize', function() {
if (window.innerWidth >= 768) { // md breakpoint
    mobileMenu.classList.add('hidden');
    mobileMenu.classList.remove('block');
    menuIcon.classList.remove('fa-times');
    menuIcon.classList.add('fa-bars');
}
    });

    // Auto-hide flash messages
    setTimeout(() => {
const flashMessage = document.getElementById('flash-message');
if (flashMessage) {
    flashMessage.style.transform = 'translateX(100%)';
    setTimeout(() => flashMessage.remove(), 300);
}
    }, 3000);
});

                                                                                                                 // JS FOR CREATE.PHP AND EDIT.PHP
 // Color selection
document.querySelectorAll('input[name="color"]').forEach(radio => {
    radio.addEventListener('change', function() {
        document.querySelectorAll('input[name="color"]').forEach(r => {
            r.parentElement.querySelector('div').classList.remove('ring-2', 'ring-indigo-500');
        });
        this.parentElement.querySelector('div').classList.add('ring-2', 'ring-indigo-500');
    });
});
                                                                                                                 // JS FOR INDEX.PHP
let currentNoteId = null;

function openNoteModal(noteId) {
    const noteCard = document.querySelector(`[data-note-id="${noteId}"]`);
    if (!noteCard) return;

    currentNoteId = noteId;
    
    // Get note data from data attributes
    const title = noteCard.getAttribute('data-note-title');
    const content = noteCard.getAttribute('data-note-content');
    const color = noteCard.getAttribute('data-note-color');
    const created = noteCard.getAttribute('data-note-created');
    const isPinned = noteCard.getAttribute('data-note-pinned') === '1';
    const isArchived = noteCard.getAttribute('data-note-archived') === '1';

    // Set modal content
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalContentText').textContent = content;
    document.getElementById('modalDate').textContent = `Created: ${created}`;
    
    // Set status badges
    let statusHtml = '';
    if (isPinned) {
        statusHtml += '<span class="bg-red-500 text-white px-2 py-1 rounded text-xs">Pinned</span>';
    }
    if (isArchived) {
        statusHtml += '<span class="bg-yellow-500 text-white px-2 py-1 rounded text-xs ml-2">Archived</span>';
    }
    document.getElementById('modalStatus').innerHTML = statusHtml;

    // Apply note color to modal
    const modalContent = document.getElementById('modalContent');
    modalContent.className = `bg-black rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-hidden transform transition-all duration-300 scale-95 opacity-0 ${color}`;

    // Show modal with animation
    const modal = document.getElementById('noteModal');
    
    modal.classList.remove('hidden');
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);

    // Add escape key listener
    document.addEventListener('keydown', handleEscapeKey);
    
    // Prevent body scroll
    document.body.style.overflow = 'hidden';
}

function closeNoteModal() {
    const modal = document.getElementById('noteModal');
    const modalContent = document.getElementById('modalContent');
    
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        currentNoteId = null;
    }, 300);

    // Remove escape key listener
    document.removeEventListener('keydown', handleEscapeKey);
    
    // Restore body scroll
    document.body.style.overflow = 'auto';
}

function handleEscapeKey(event) {
    if (event.key === 'Escape') {
        closeNoteModal();
    }
}

function editNote() {
    if (currentNoteId) {
        window.location.href = `/notes/${currentNoteId}/edit`;
    }
}

// Close modal when clicking outside
document.getElementById('noteModal').addEventListener('click', function(event) {
    if (event.target === this) {
        closeNoteModal();
    }
});

// Prevent event bubbling for action buttons
document.querySelectorAll('.note-card form, .note-card a').forEach(element => {
    element.addEventListener('click', function(event) {
        event.stopPropagation();
    });
});