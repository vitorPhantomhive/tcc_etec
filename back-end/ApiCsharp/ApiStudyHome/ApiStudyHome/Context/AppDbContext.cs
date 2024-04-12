using ApiStudyHome.Models;
using Microsoft.EntityFrameworkCore;

namespace ApiStudyHome.Context
{
    //Arquivo de configuração para infomrar quem tem que ir para o banco e representando qual model
    public class AppDbContext : DbContext
    {
        public AppDbContext(DbContextOptions<AppDbContext> options) : base(options)
        {

        }
        public DbSet<Aluno> Alunos { get; set; }
        public DbSet<Anotacao> Anotacoes { get; set; }
        public DbSet<ArquivoEntregue> ArquivoEntregues { get; set; }
        public DbSet<TarefaEntregue> Entregue { get; set; }

        public DbSet<Escola> Escolas {get; set;}
        public DbSet<Materia> Materias {get; set;}
        public DbSet<Professor> Professores { get; set; }

        public DbSet<Tarefa> Tarefas {get; set;}
        public DbSet<Turma> Turmas { get; set; }
        public DbSet<TurmaProfessor> TurmaProfessor {get; set;}


        
        




    }
}
