using System.ComponentModel.DataAnnotations.Schema;

namespace ApiStudyHome.Models
{
    [Table("professor")]
    public class Professor
    {
        public int Id{ get; set; }
        public string Nome { get; set; }
        public string Email { get; set; }
        public string Senha { get; set; }
        public int Telefone { get; set; }
        public bool Ativo {  get; set; }
        public string Cpf { get; set; }

        // Relacionamento muitos-para-muitos com Turma
        public ICollection<Materia>? Materias { get; set; }
        public ICollection<TurmaProfessor>? Turmas { get; set; }
        public ICollection<Tarefa>? Tarefas { get; set; }


        public void Update(string nome, string email, string senha, int telefone, bool ativo, string cpf)
        {
            Nome = nome;
            Email = email;
            Senha = senha;
            Telefone = telefone;
            Ativo = ativo;
            Cpf = cpf;

        }
    }
}
