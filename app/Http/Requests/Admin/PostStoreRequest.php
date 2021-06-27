<?php

namespace App\Http\Requests\Admin;

use App\Enums\PostStatusEnum;
use App\Models\PostCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Spatie\Enum\Laravel\Rules\EnumRule;

class PostStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required'],
            'slug' => ['nullable'],
            'status' => new EnumRule(PostStatusEnum::class),
            'category_id' => ['required', Rule::exists(PostCategory::class, 'id')],
            'summary' => ['nullable'],
            'body' => ['nullable'],
            'published_at' => ['nullable', 'date'],
            'pin' => ['boolean'],
            'promote' => ['boolean'],
            'meta_title' => ['nullable'],
            'meta_description' => ['nullable'],
        ];
    }

    public function prepareForValidation()
    {
        $status = PostStatusEnum::draft();

        if ($this->publish) {
            $status = $this->published_at > Carbon::now()
                ? PostStatusEnum::scheduled()
                : PostStatusEnum::published();
        }

        $this->merge([
            'status' => $status,
        ]);
    }
}
