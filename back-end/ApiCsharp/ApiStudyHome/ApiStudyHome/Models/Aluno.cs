﻿using System.ComponentModel.DataAnnotations.Schema;

namespace ApiStudyHome.Models   
{
    [Table("alunos")]
    public class Aluno
    {
        public void Update( int TurmaId, string nome, string email, string senha, int telefone, bool ativo, string cpf)
        {
            Nome = nome;
            Email = email;
            Senha = senha;
            Telefone = telefone;
            Ativo = ativo;
            Cpf = cpf;
        }

        public int Id { get; set; }

        //Relacionamento com a turma 
        [ForeignKey("Turma")]
        public int? TurmaId { get; set; }
        public Turma? Turma { get; set; }

        public string Nome { get; set; }
        public string Email { get; set; }
        public string Senha { get; set; }
        public int Telefone { get; set; }
        public bool Ativo { get; set; }
        public string Cpf { get; set; }

        public ICollection<TarefaEntregue>? Entregas { get; set; }

        
    }
}
