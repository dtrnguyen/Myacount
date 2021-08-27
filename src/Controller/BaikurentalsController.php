<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Baikurentals Controller
 *
 * @method \App\Model\Entity\Baikurental[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BaikurentalsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $baikurentals = $this->paginate($this->Baikurentals);

        $this->set(compact('baikurentals'));
    }

    /**
     * View method
     *
     * @param string|null $id Baikurental id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $baikurental = $this->Baikurentals->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('baikurental'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $baikurental = $this->Baikurentals->newEmptyEntity();
        if ($this->request->is('post')) {
            $baikurental = $this->Baikurentals->patchEntity($baikurental, $this->request->getData());
            if ($this->Baikurentals->save($baikurental)) {
                $this->Flash->success(__('The baikurental has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The baikurental could not be saved. Please, try again.'));
        }
        $this->set(compact('baikurental'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Baikurental id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $baikurental = $this->Baikurentals->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $baikurental = $this->Baikurentals->patchEntity($baikurental, $this->request->getData());
            if ($this->Baikurentals->save($baikurental)) {
                $this->Flash->success(__('The baikurental has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The baikurental could not be saved. Please, try again.'));
        }
        $this->set(compact('baikurental'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Baikurental id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $baikurental = $this->Baikurentals->get($id);
        if ($this->Baikurentals->delete($baikurental)) {
            $this->Flash->success(__('The baikurental has been deleted.'));
        } else {
            $this->Flash->error(__('The baikurental could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
