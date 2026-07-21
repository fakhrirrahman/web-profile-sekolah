<?php

namespace App\View\Components\Announcement;

use App\Models\Announcement;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CreateModal extends Component
{
    public bool $isEdit;
    public string $modalTitle;
    public string $submitLabel;
    public string $triggerLabel;
    public string $buttonVariant;
    public string $action;
    public string $titleId;
    public string $categoryId;
    public string $dateId;
    public string $contentTypeId;
    public string $copyId;
    public string $pdfId;
    public string $defaultDate;
    public array $categoryOptions;

    public function __construct(
        public string $id = 'announcement-create-modal',
        public ?Announcement $announcement = null,
        ?string $triggerLabel = null,
        ?string $buttonVariant = null,
    ) {
        $this->isEdit = filled($this->announcement?->getKey());
        $this->modalTitle = $this->isEdit ? 'Edit Pengumuman' : 'Tambah Pengumuman Baru';
        $this->submitLabel = $this->isEdit ? 'Simpan Perubahan' : 'Tambah Pengumuman';
        $this->triggerLabel = $triggerLabel ?? ($this->isEdit ? 'Edit' : 'Tambah Pengumuman');
        $this->buttonVariant = $buttonVariant ?? ($this->isEdit ? 'outline' : 'accent');
        $this->action = $this->isEdit
            ? route('admin.announcements.update', $this->announcement)
            : route('admin.announcements.store');

        $fieldPrefix = str_replace(['.', '[', ']'], '-', $this->id);
        $this->titleId = $fieldPrefix . '-title';
        $this->categoryId = $fieldPrefix . '-category';
        $this->dateId = $fieldPrefix . '-date';
        $this->contentTypeId = $fieldPrefix . '-content-type';
        $this->copyId = $fieldPrefix . '-copy';
        $this->pdfId = $fieldPrefix . '-pdf';
        $this->defaultDate = $this->announcement?->date ?? now()->isoFormat('D MMMM Y');
        $this->categoryOptions = ['Pendaftaran', 'Akademik', 'Info Orang Tua', 'Kegiatan'];
    }

    public function render(): View
    {
        return view('components.announcement.create-modal');
    }
}
