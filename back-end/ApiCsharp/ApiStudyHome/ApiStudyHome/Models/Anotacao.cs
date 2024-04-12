using Microsoft.VisualStudio.Web.CodeGenerators.Mvc.Templates.BlazorIdentity.Pages.Manage;
using System.ComponentModel.DataAnnotations.Schema;

namespace ApiStudyHome.Models
{
    [Table("anotacao")]
    public class Anotacao
    {

        public void Update(string nome, string descricao, DateTime dataNota, int idUser, string tipoUser)
        {
            Nome = nome;
            Descricao = descricao;
            DataNota = dataNota;
            IdUsuario = idUser;
            TipoUsuario = tipoUser; 
        }
        public int Id { get; set; }
        public string Nome { get; set; }
        public string Descricao { get; set; }
        public DateTime DataNota { get; set; }
        public int IdUsuario { get; set; }
        public string TipoUsuario { get; set; }


    }
}
