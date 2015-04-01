<?php

class Photo extends Eloquent {
	protected $guarded = array();

	protected $table = 'photos';

	public static $order_by = 'photos.id DESC';

	public function thumb() {
		#return link::to(Config::get('site.galleries_thumb_dir')) . "/" . $this->name;
		return URL::to(Config::get('site.galleries_thumb_public_dir') . "/" . $this->name);
	}

	public function full() {
		return $this->path();
	}

	public function path() {
		#return link::to(Config::get('site.galleries_photo_dir')) . "/" . $this->name;
		return URL::to(Config::get('site.galleries_photo_public_dir') . "/" . $this->name);
	}

    public function thumbpath() {
        #return link::to(Config::get('site.galleries_photo_dir')) . "/" . $this->name;
        return str_replace('//', '/', public_path(Config::get('site.galleries_thumb_public_dir') . "/" . $this->name));
    }

    public function fullpath() {
        #return link::to(Config::get('site.galleries_photo_dir')) . "/" . $this->name;
        return str_replace('//', '/', public_path(Config::get('site.galleries_photo_public_dir') . "/" . $this->name));
    }

    public function is_correct() {
        $exists_thumb = file_exists($this->thumbpath());
        $exists_full  = file_exists($this->fullpath());
        return (bool)($exists_thumb && $exists_full);
    }

    public function extract() {
        return $this;
    }

    public function full_delete() {

        ## Check upload & thumb dir
        $uploadPath = Config::get('site.galleries_photo_dir');
        $thumbsPath = Config::get('site.galleries_thumb_dir');
        $cachePath = public_path(Config::get('site.galleries_cache_public_dir'));

        @unlink($uploadPath . '/' . $this->name);
        @unlink($thumbsPath . '/' . $this->name);

        $cache_files = glob($cachePath . '/' . $this->id . "_*");
        foreach ($cache_files as $cache_file)
            @unlink($cache_file);

        $this->delete();

        return true;
    }
}