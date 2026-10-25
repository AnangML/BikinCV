<?php

declare(strict_types=1);

namespace App\Http\Requests\Cv;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

final class SaveCvRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cv_id' => ['nullable', 'integer', 'exists:cvs,id'],
            'title' => ['required', 'string', 'max:120'],
            'content' => ['required', 'array'],
            'template_id' => ['required', 'string', 'in:classic,modern,tech,compact,academic,nordic,finance,corporate'],
            'selected_font' => ['required', 'string', 'in:inter,roboto,jakarta,arial,merriweather,georgia,garamond'],
            'doc_font_size' => ['required', 'string', 'in:doc-size-sm,doc-size-base,doc-size-lg'],
            'accent_color' => ['required', 'string', 'max:25'],
            'ats_score' => ['nullable', 'integer', 'min:0', 'max:100'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Judul CV wajib diisi.',
            'content.required' => 'Data konten CV tidak boleh kosong.',
            'template_id.in' => 'Template yang dipilih tidak valid.',
        ];
    }
}
