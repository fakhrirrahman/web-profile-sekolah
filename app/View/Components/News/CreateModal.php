<?php

namespace App\View\Components\News;

use App\Models\News;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
    public string $imageId;
    public string $dropzoneId;
    public string $dzIconId;
    public string $dzPreviewId;
    public string $dzTextId;
    public string $dzMetaId;
    public string $btnRemoveId;
    public string $removeImageId;
    public string $copyId;
    public string $defaultDate;
    public array $categoryOptions;
    public ?string $currentImageUrl;
    public ?string $currentImageName;

    public function __construct(
        public string $id = 'news-create-modal',
        public ?News $news = null,
        ?string $triggerLabel = null,
        ?string $buttonVariant = null,
    ) {
        $this->isEdit = filled($this->news?->getKey());
        $this->modalTitle = $this->isEdit ? 'Edit Berita' : 'Tambah Berita Baru';
        $this->submitLabel = $this->isEdit ? 'Simpan Perubahan' : 'Tambah Berita';
        $this->triggerLabel = $triggerLabel ?? ($this->isEdit ? 'Edit' : '+ Tambah Berita');
        $this->buttonVariant = $buttonVariant ?? ($this->isEdit ? 'outline' : 'accent');
        $this->action = $this->isEdit
            ? route('admin.news.update', $this->news)
            : route('admin.news.store');

        $fieldPrefix = str_replace(['.', '[', ']'], '-', $this->id);
        $this->titleId = $fieldPrefix . '-title';
        $this->categoryId = $fieldPrefix . '-category';
        $this->dateId = $fieldPrefix . '-date';
        $this->imageId = $fieldPrefix . '-image';
        $this->dropzoneId = $fieldPrefix . '-dropzone';
        $this->dzIconId = $fieldPrefix . '-dz-icon';
        $this->dzPreviewId = $fieldPrefix . '-dz-preview';
        $this->dzTextId = $fieldPrefix . '-dz-text';
        $this->dzMetaId = $fieldPrefix . '-dz-meta';
        $this->btnRemoveId = $fieldPrefix . '-btn-remove';
        $this->removeImageId = $fieldPrefix . '-remove-image';
        $this->copyId = $fieldPrefix . '-copy';
        $this->defaultDate = $this->news?->date ?? now()->isoFormat('D MMMM Y');
        $this->categoryOptions = ['Prestasi', 'Kegiatan', 'Akademik', 'Info Orang Tua'];
        $this->currentImageUrl = $this->resolveCurrentImageUrl();
        $this->currentImageName = $this->news?->image ? basename($this->news->image) : null;
    }

    public function render(): View
    {
        return view('components.news.create-modal');
    }

    private function resolveCurrentImageUrl(): ?string
    {
        if (blank($this->news?->image)) {
            return null;
        }

        if (isset($this->news->image_url)) {
            return $this->news->image_url;
        }

        if (Str::startsWith($this->news->image, ['http://', 'https://', '/'])) {
            return $this->news->image;
        }

        return Storage::disk('public')->url($this->news->image);
    }
}
