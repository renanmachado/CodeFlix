<?php

namespace CodeFlix\Http\Controllers\Admin\Auth;

use Auth;
use CodeFlix\Repositories\UserRepository;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\Facades\FormBuilder;
use CodeFlix\Forms\UserSettingsForm;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;

class UserSettingsController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UserSettingsController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        /** @var Form $form */
        $form = FormBuilder::create(UserSettingsForm::class, [
            'url' => route('admin.user_settings.update'),
            'method' => 'PUT'
        ]);

        return view('admin.auth.setting', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        /** @var Form $form */
        $form = FormBuilder::create(UserSettingsForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        $this->repository->update($data, Auth::user()->id);
        $request->session()->flash('message', 'Senha alterada com sucesso');

        return redirect()->route('admin.user_settings.edit');
    }
}
